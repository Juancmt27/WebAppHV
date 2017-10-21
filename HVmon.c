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

/* Program Description. */
static char doc[] =
  "Script to monitor CAEN HV supply. Prints the on/off status, current voltage, set voltage, current, and trip current of a given channel in a slot, or for all channels.";



/* List of possible arguments */
static struct argp_option options[] = {
  {"ip",'p',"char",0,"IP address of device"},
  {"slot",'s',"int",0,"Slot in crate to interface with (0-3)"},
  {"channel",'c',"int",0,"Channel to check (0-11)"},
  {"allchans",'a',0,0,"Get status of all channels"},
  { 0 }
};


struct arguments
{ 
  int ip;
  int slot;
  int channel;
  int allchans;
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
    case 'c':
      arguments->channel=atoi(arg);
      break;
    case 'a':
      arguments->allchans=1;
      break;
    }
  return 0;
}

static struct argp argp = { options, parse_opt, doc };
int main(int argc, char **argv)
{
  struct arguments arguments;
  arguments.ip="192.168.42.181"; 
  arguments.slot=-1;
  arguments.channel=-2;
  arguments.allchans=0;

  argp_parse (&argp, argc, argv, 0, 0, &arguments);
/* inintialize CAEN parameters and log in */
  int LinkType = 0;		       	
	
  /*Login credentials and other system paramters */
  const char *Arg = &arguments.ip;
  //char *Arg = "192.168.42.181";	      
  const char *UserName = "admin";	
  const char *Passwd = "admin";
  int handle; //keeps track of current login session

  
  unsigned short nslot;
  short unsigned *nchannels=NULL;
  char *modelist=NULL;
  char *descrlist=NULL;
  short unsigned *sernums=NULL;
  unsigned char *fmwmin=NULL;
  unsigned char *fmwmax=NULL;
  
     
  /* Declare pointers for commands */
 
  unsigned short Slot, ChNum, *ChList;
  int *PwList;
  float *VMonList, *IMonList;
  float *VSetList, *ISetList;
  // Exit and print warning if no slot or nonexistent slot is specified
  if(arguments.slot<0 || arguments.slot>3){
    printf("Please specify a slot (0, 1, 2, or 3)\n");
    exit(0);
  }
  
  else if(arguments.allchans>0 && arguments.channel>-1){
    printf("Too many command line arguments (specify a channel with -c or view all channels with -a)\n");
    exit(0);
      }
  // Begin sending commands if all is well
  
  else{
    Slot=arguments.slot; 

    //xml file to export data to
    
    if(arguments.allchans>0){
      ChNum=12;
      ChList=malloc(ChNum*sizeof(unsigned short));
      PwList=malloc(ChNum*sizeof(int));
      VMonList=malloc(ChNum*sizeof(float));
      VSetList=malloc(ChNum*sizeof(float));
      IMonList=malloc(ChNum*sizeof(float));
      ISetList=malloc(ChNum*sizeof(float));
      
      int i;
      for(i=0;i<12;i++){
	ChList[i]=i;
      }
 
      for(i=0;i<ChNum;i++){
	printf("Channel%i is %s\n",ChList[i],PwList[i] ? "ON":"OFF");
	printf("VMon = %f\n",VMonList[i]);
	printf("V0Set = %f\n",VSetList[i]);
	printf("IMon = %f\n", IMonList[i]);
	printf("I0Set = %f\n\n",ISetList[i]);
     	}
      free(ChList);
      free(PwList);
      free(VMonList);
      free(VSetList);
      free(IMonList);
      free(ISetList);
    }

    else if(arguments.channel>-1){
      ChNum=1;
      ChList=malloc(ChNum*sizeof(unsigned short));
      ChList[0]=arguments.channel;
      PwList=malloc(ChNum*sizeof(int));
      VMonList=malloc(ChNum*sizeof(float));
      VSetList=malloc(ChNum*sizeof(float));
      IMonList=malloc(ChNum*sizeof(float));
      ISetList=malloc(ChNum*sizeof(float));

      printf("Channel%i is %s\n",ChList[0],PwList[0] ? "ON":"OFF");
      printf("VMon = %f\n",VMonList[0]);
      printf("V0Set = %f\n",VSetList[0]);
      printf("IMon = %f\n", IMonList[0]);
      printf("I0Set = %f\n\n",ISetList[0]);
      
      free(ChList);
      free(PwList);
      free(VMonList);
      free(VSetList);
      free(IMonList);
      free(ISetList);
  }
}
 exit(0);
}

