#include <signal.h>
#ifdef UNIX
#include <sys/time.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <termios.h>
#include <unistd.h>
#endif
#include <fcntl.h>
#include <string.h>
#include <stdlib.h>
#include <stdio.h>
#include <errno.h>
#include <argp.h>




/* Initialize argument parser */


/* Program Description. */
static char doc[] =
  "Script to control CAEN HV supply. Accepts either a single channel, plus voltage or current, or text files of channels and desired voltages or currents.  Must specify which slot to turn on in each case.";



/* List of possible arguments */
static struct argp_option options[] = {
  {"ip",'p',"char",0,"IP address of device to interface with"},
  {"slot",'s',"int",0,"Slot in crate to interface with (0-3)"},
  {"channel",'c',"int",0,"Channel to turn on (0-11)"},
  {"voltage", 'v', "double",0,"Turn on the channel with specified voltage (V)"},
  {"turnon", 'o', 0,0, "Turn off the channel"},
  {"current",'I', "double",0, "Set the channel current limit (microAmps)"},
  {"turnoff",'t',0,0,"Turn off the channel"},
  {"vfile",'f', "FILE", 0, "ASCII file of channels and voltages (tab delimited)"},
  {"Ifile",'F', "FILE", 0, "ASCII file of channels and current limits (tab delimited)"},
  {"slotoff",'k',0,0,"Turn off all channels in slot"},
  { 0 }
};


struct arguments
{ 
  char *ip;
  int slot;
  const char *vfile, *Ifile;
  double voltage;
  double current;
  int channel;
  int turnoff, turnon,  slotoff;
};


static error_t
parse_opt (int key, char *arg, struct argp_state *state)
{

  struct arguments *arguments = state->input;

  switch (key)
    {
    case 'p':
      arguments->ip = arg;
      break;
    case 's':
      arguments->slot = atoi(arg);
      break;
    case 'f':
      arguments->vfile = arg;
      break;
    case 'F':
      arguments->Ifile = arg;
      break;
    case 'c':
      arguments->channel = atoi(arg);
      break;
    case 'v':
      arguments->voltage = atoi(arg);
      break;
    case 'I':
      arguments->current = atoi(arg);
      break;
    case 't':
      arguments->turnoff = 1;
      break;
    case 'o':
      arguments->turnon = 1;
    case 'k':
      arguments->slotoff = 1;
      break;
    }
  return 0;
}

static struct argp argp = { options, parse_opt, doc };

int main(int argc, char **argv)
{
  struct arguments arguments;

  /* Default values. */
  arguments.ip="192.168.42.181";
  arguments.slot=-1;
  arguments.vfile = NULL;
  arguments.Ifile = NULL;
  arguments.channel=-2;
  arguments.voltage= -1;
  arguments.current= -1;
  arguments.turnon=0;
  arguments.turnoff= 0;
  arguments.slotoff=0;
   
  /* Parse given arguments and print to check them */
  argp_parse (&argp, argc, argv, 0, 0, &arguments);

  /* Optional print statements for debugging 
  printf("slot= %i\n",arguments.slot);
  printf("file= %s \n",arguments.file);
  printf("Voltage = %f\n",arguments.voltage);
  printf("Turnoff = %i\n",arguments.turnoff); */
  


  /* inintialize CAEN parameters and log in */
        int LinkType = 0;		       	
	
	/*Login credentials and other system paramters */
	char *Arg = arguments.ip;
	//char *Arg = "192.168.42.181";	      
	const char *UserName = "admin";	
	const char *Passwd = "admin";
	int handle; //keeps track of current login session
	
	/*Begin interfacing with the supply */
	
	//Exit if no supply is found
		unsigned short nslot;
	short unsigned *nchannels=NULL;
	char *modelist=NULL;
	char *descrlist=NULL;
	short unsigned *sernums=NULL;
        unsigned char *fmwmin=NULL;
	unsigned char *fmwmax=NULL;

	/* Function to get basic information about the supply */

	
	
     
	/* Declare pointers for commands */
 
	unsigned short Slot, ChNum, *ChList;
	int *turnonlist, *turnofflist;
	float *VList, *IList;
	
	
	/* Exit and print warning if no slot or nonexistent slot is specified
	   or contradictory command line args are given */
	
	if(arguments.slot<0 || arguments.slot>3){
	  printf("Please specify a slot (0, 1, 2, or 3)\n");
	  exit(0);
	}
	if(arguments.channel<0 && arguments.slot>-1 && arguments.slotoff<1 && arguments.turnon<1){
	  printf("Not enough arguments\n");
	  exit(0);
	}
	
	if(arguments.channel>-1 && arguments.vfile!=NULL || arguments.channel>-1 && arguments.Ifile!=NULL || arguments.turnon>0 && arguments.turnoff>0){
	  printf("Too many command line arguments given\n");
	  exit(0);
	}

	if(arguments.channel>-1 && arguments.voltage<0 && arguments.current<0 && arguments.turnoff<1 && arguments.turnon<1){
	  printf("Please specify an action for channel%i\n",arguments.channel);
	  exit(0);
	}
	if(arguments.channel<0 && arguments.voltage>0 || arguments.channel<0 && arguments.current>0){
	  printf("No channel specifed\n");
	  exit(0);
	    }

	// Begin sending commands if all is well
	else{
	   Slot=arguments.slot;
	   int nchan=0;

	   //If file is specified, read it and use the contents
	   
	   if(arguments.vfile != NULL){
	    
 	     FILE *fp=fopen(arguments.vfile,"r");
	    
	     char line[256];
	     printf("Slot = %i\n",Slot);
	     printf ("VFile = %s\n",
		     arguments.vfile);
	     
	     //get number of channels in file
	     int ch;
	     do {ch=fgetc(fp);
		 if(ch == '\n')
		   nchan++;
	       } while(ch != EOF); 
	     fclose(fp);
	    
	     /* Initialized parameter arrays now that we have the number of 
		channels */
	     
	    unsigned short *channels = malloc(nchan * sizeof(unsigned short));
	    float *voltages = malloc(nchan * sizeof(float));
	     
	    
	     printf("%i channels given\n",nchan);
	     //size_t read;
	     
	     
	     fp=fopen(arguments.vfile,"r");
	     
	     int i=0;
	     while(fscanf(fp,"%i %f",&channels[i],&voltages[i]) != EOF){
	       
	       //printf("Ch %ishould be %i\n",channels[i]);
	       //printf("Voltage should be %f\n",voltages[i]);
	       
	       i++;
	     }
	     fclose(fp);
	     
	     /* Now send the list of commands to the supply.  Need to do this one at a time  in a loop due to a bug. 
		Cumbersome, but effective. */
	
	     for(i=0;i<nchan;i++){
	       ChNum=1;//only setting one channel each iteration
	       
	       ChList = malloc(ChNum * sizeof(unsigned short));
	     
	       turnonlist = malloc(ChNum * sizeof(unsigned int));
	  
	       VList=malloc(ChNum * sizeof(float));
	       
	       ChList[0]=channels[i];
	       turnonlist[0]=1;
	       VList[0]=voltages[i];
	          
	       //set channel voltages and throw an alert if failure occures
	       
	       printf("Ch%i set to %f\n",ChList[0],VList[0]);

	       //free allocated memory
	       free(ChList);
	       
	       free(turnonlist);
	       free(VList);
	     }
	     free(channels);
	     free(voltages);
	   }

	   /* if current file provided, repeat the above procedure to set 
	      max current */
	    if(arguments.Ifile != NULL){
	    
 	     FILE *fp=fopen(arguments.Ifile,"r");
	    
	     char line[256];
	     printf("Slot = %i\n",Slot);
	     printf ("IFile = %s\n",
		     arguments.Ifile);
	     
	     //get number of channels in file
	     int ch;
	     do {ch=fgetc(fp);
		 if(ch == '\n')
		   nchan++;
	       } while(ch != EOF); 
	     fclose(fp);
	    
	     /* Initialized parameter arrays now that we have the number of 
		channels */
	     
	    unsigned short *channels = malloc(nchan * sizeof(unsigned short));
	    float *currents = malloc(nchan * sizeof(float));
	     
	    
	     printf("%i channels given\n",nchan);
	     //size_t read;
	     
	     
	     fp=fopen(arguments.Ifile,"r");
	     
	     int i=0;
	     while(fscanf(fp,"%i %f",&channels[i],&currents[i]) != EOF){
	       
	       //printf("Ch %ishould be %i\n",channels[i]);
	       //printf("Voltage should be %f\n",voltages[i]);
	       
	       i++;
	     }
	     fclose(fp);
	     
	     /* Now send the list of commands to the supply.  Need to do this one at a time  in a loop due to a bug. 
		Cumbersome, but effective. */
	
	     for(i=0;i<nchan;i++){
	       ChNum=1;//only setting one channel each iteration
	       
	       ChList = malloc(ChNum * sizeof(unsigned short));
	     
	       
	  
	       IList=malloc(ChNum * sizeof(float));
	       
	       ChList[0]=channels[i];
	      
	       IList[0]=currents[i];
	       
	       //set channel trip currents and throw an alert if failure occures

	       //free allocated memory
	       free(ChList);
	       free(IList);
	     }
	     free(channels);
	     free(currents);
	   }
	   
	   // Interface with only the given channel if no files specified

	   if(-1<arguments.channel && arguments.channel<12){
	     //printf("Channel is %i\n",arguments.channel);
	     ChNum = 1; //how many channels you want read
     	  
	     //Turn off specified channel
	     if(arguments.turnoff>0){
	       
	       // initialize arrays 
	       ChList=malloc(ChNum*sizeof(unsigned short));
	       
	       turnofflist = malloc(ChNum * sizeof(unsigned int));
	       VList=malloc(ChNum * sizeof(float));  
	  
	       ChList[0]=arguments.channel;
	       turnofflist[0]=0; //0 means off
	       
	       //Pass turn off command to supply
	       printf("Killing channel %i in slot %i\n",ChList[0],Slot);
	  
	       free(ChList);
	       
	       free(turnofflist);
	       free(VList);
	   
	     }
             else if (arguments.turnon>0){
		// initialize arrays
		ChList=malloc(ChNum*sizeof(unsigned short));
		turnonlist = malloc(ChNum * sizeof(unsigned int));
		VList=malloc(ChNum * sizeof(float));
                 
		ChList[0]=arguments.channel;
		turnonlist[0]=1;
		turnonlist= malloc(ChNum * sizeof(unsigned int));
               	printf("Turning on channel %i in slot %i\n",ChList[0],Slot);

                free(ChList);

                free(turnonlist);
                free(VList);
		}	 
	     if(arguments.voltage>0){
	       
	       //Initialize arrays of parameters
	       ChList = malloc(ChNum*sizeof(unsigned short));
	       
	       //turnonlist = malloc(ChNum * sizeof(unsigned int));
	  
	       VList=malloc(ChNum * sizeof(float));                             	  
	       ChList[0]=arguments.channel;

	       turnonlist[0]=1;//1 means on
	       VList[0]=arguments.voltage;
	       
	       //Turn on the channel
	       //CAENHV_SetChParam(handle,Slot,"Pw",ChNum,ChList, turnonlist);
	       //printf("Slot = %i\n",Slot);
	       printf("Chan%i V0Set = %f \n",ChList[0],VList[0]);
	       
	       //Set the high voltage for the turned on channel
	       
	       //Free the allocated memory
	       free(ChList);
	      
	       free(turnonlist);
	       free(VList);
	     }
	    else if(arguments.current>0){
	       
	       //Initialize arrays of parameters
	       ChList = malloc(ChNum*sizeof(unsigned short));
	  
	       IList=malloc(ChNum * sizeof(float));                             	  
	       ChList[0]=arguments.channel;
	       IList[0]=arguments.current;
	       
	       printf("Slot = %i\n",Slot);
	       printf("Chan%i I0Set = %f \n",ChList[0],IList[0]);
	       
	       //Set the max current for the turned on channel
	 	       
	       //Free the allocated memory
	       free(ChList);
	      
	       free(IList);
	     }
	   }


	//If --slotoff is given, turn off all channels in slot
	   else if(arguments.slotoff>0){
	     
	     ChNum=12;//want an array of all 12 channels
	     
	     ChList=malloc(ChNum*sizeof(float));
	     
	     
	  
	     turnonlist = malloc(ChNum * sizeof(unsigned int));
	  
	     VList=malloc(ChNum * sizeof(float));  	  
	     int i;
	     for(i=0;i<12;i++){
	       ChList[i]=i;
	       turnonlist[i]=0;
	       //printf("ChList %i=%i\n",i,i);
	     }
	  
	     //Pass the array to turn off all 12 channels
	     printf("Killing all channels in slot %i\n",Slot);
	     
	     free(ChList);
	     
	     free(turnonlist);
	     free(VList);
	   }
	}
	
	//Disconnect from supply


	return 0;

}
