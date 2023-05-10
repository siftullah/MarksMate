#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <stdbool.h>
#include <math.h>

//a helper function for calculating LCM which will be used to calculate total time of gantt chart 
int LCM_calculator(int arr[], int size)
{
	int temp[size];

	int index;
	
	for(index=0;index<size;index++)
	{
		temp[index] = arr[index];
	}
	
	int divisor = 2;
	int LCM = 1;
	
	bool all_numbers_are_one;
	bool valid_prime_factor; 
	
	while(true)
	{
		all_numbers_are_one = true;
		
		for(index = 0; index<size; index++)
		{	
			if(temp[index] != 1)
			{
				all_numbers_are_one = false;
				break;
			}
		}
		
		if(all_numbers_are_one == true)
			break;
			
		valid_prime_factor = false;
			
		for(index=0; index<size; index++)
		{
			if(temp[index] % divisor == 0)
			{
				temp[index] = temp[index] / divisor;
				valid_prime_factor = true;
			}
		}
		
		if(valid_prime_factor == true)
			LCM = LCM * divisor;
		else
			divisor++;
	}
	
	return LCM;
}

//a helper function for printing gantt chart
void printGanttChart(int gantt_chart[], int total_time)
{
	int index;
	int temp_arr[total_time];
	int temp_index=0;
	
	for(index=0; index<total_time; index++)
	{
		if(index==0)
		{
			printf("+----");
		}
		else if(gantt_chart[index] != gantt_chart[index-1])
		{
			if(gantt_chart[index-1] == -1)
				printf("----");
			else
			{
				printf("-");
				
				int temp = gantt_chart[index-1];
				
				if(temp == 0)
				{
					printf("-");
				}
				else
				{
					while(temp != 0)
					{
						printf("-");
						temp = temp/10;
					}
				}
			}
			printf("----+----");
		}
	}
	
	if(gantt_chart[index-1] == -1)
		printf("----");
	else
	{
		printf("-");
		
		int temp = gantt_chart[index-1];
		
		if(temp == 0)
		{
			printf("-");
		}
		else
		{
			while(temp != 0)
			{
				printf("-");
				temp = temp/10;
			}
			
		}
	}
	printf("----+");
	
	printf("\n");
	
	for(index=0; index<total_time; index++)
	{
		if(index==0)
		{
			printf("|    ");
		}
		else if(gantt_chart[index] != gantt_chart[index-1])
		{
			if(gantt_chart[index-1] == -1)
				printf("IDLE");
			else
			{
				printf("P");
				
				int temp = gantt_chart[index-1];
				
				if(temp == 0)
				{
					printf("0");
				}
				else
				{
					while(temp != 0)
					{
						temp_arr[temp_index] = temp%10;
						temp = temp/10;
						temp_index++;
					}
					
					temp_index--;
					
					while(temp_index >= 0)
					{
						printf("%d",temp_arr[temp_index]);
						temp_index--;
					}
					
					temp_index=0;
				}
			}
			printf("    |    ");
		}
	}
	
	if(gantt_chart[index-1] == -1)
		printf("IDLE");
	else
	{
		printf("P");
		
		int temp = gantt_chart[index-1];
		
		if(temp == 0)
		{
			printf("0");
		}
		else
		{
			while(temp != 0)
			{
				temp_arr[temp_index] = temp%10;
				temp = temp/10;
				temp_index++;
			}
			
			temp_index--;
			
			while(temp_index >= 0)
			{
				printf("%d",temp_arr[temp_index]);
				temp_index--;
			}
			
			temp_index=0;
		}
	}
	printf("    |");
	
	printf("\n");
	
	for(index=0; index<total_time; index++)
	{
		if(index==0)
		{
			printf("+----");
		}
		else if(gantt_chart[index] != gantt_chart[index-1])
		{
			if(gantt_chart[index-1] == -1)
				printf("----");
			else
			{
				printf("-");
				
				int temp = gantt_chart[index-1];
				
				if(temp == 0)
				{
					printf("-");
				}
				else
				{
					while(temp != 0)
					{
						printf("-");
						temp = temp/10;
					}
				}
			}
			printf("----+----");
		}
	}
	
	if(gantt_chart[index-1] == -1)
		printf("----");
	else
	{
		printf("-");
		
		int temp = gantt_chart[index-1];
		
		if(temp == 0)
		{
			printf("-");
		}
		else
		{
			while(temp != 0)
			{
				printf("-");
				temp = temp/10;
			}
			
		}
	}
	printf("----+");
	
	printf("\n");
	
	for(index=0; index<total_time; index++)
	{
		if(index==0)
		{
			printf("0    ");
		}
		else if(gantt_chart[index] != gantt_chart[index-1])
		{
			if(gantt_chart[index-1] == -1)
				printf("    ");
			else
			{
				printf(" ");
				
				int temp = gantt_chart[index-1];
				
				if(temp == 0)
				{
					printf(" ");
				}
				else
				{
					while(temp != 0)
					{
						printf(" ");
						temp = temp/10;
					}
				}
			}
			printf("    ");
			
			int temp = index;
			
			temp_index=0;
			
			while(temp != 0)
			{
				temp_arr[temp_index] = temp % 10;
				temp = temp / 10;
				temp_index++;	
			}
			
			int temp2 = 4-(temp_index-1);
			temp_index--;
			
			while(temp_index >= 0)
			{
				printf("%d",temp_arr[temp_index]);
				temp_index--;
			}
			
			while(temp2 > 0)
			{
				printf(" ");
				temp2--;
			}
		}
	}
	
	if(gantt_chart[index-1] == -1)
		printf("    ");
	else
	{
		printf(" ");
		
		int temp = gantt_chart[index-1];
		
		if(temp == 0)
		{
			printf(" ");
		}
		else
		{
			while(temp != 0)
			{
				printf(" ");
				temp = temp/10;
			}
		}
	}
	printf("    ");
	
	int temp = index;
	
	temp_index=0;
	
	while(temp != 0)
	{
		temp_arr[temp_index] = temp % 10;
		temp = temp / 10;
		temp_index++;	
	}
	
	temp_index--;
	
	while(temp_index >= 0)
	{
		printf("%d",temp_arr[temp_index]);
		temp_index--;
	}
	
	printf("\n\n");
}

int main()
{
	printf("\n");
	int total_processes;
	
	printf("Give total number of processes : ");
	scanf("%d",&total_processes);
	
	while(total_processes <= 0)
	{
		printf("Error!!! Total number of processes cannot be zero or negative\n");
		printf("Give total number of processes : ");
		scanf("%d",&total_processes);
	}
	
	printf("\n");
	
	int time_period_array[total_processes];
	int execution_time_array[total_processes];
	
	int index;
	
	for(index=0; index<total_processes; index++)
	{
		printf("Enter Time Period of Process P%d : ",index);
		scanf("%d",&time_period_array[index]);
		
		while(time_period_array[index] <= 0)
		{
			printf("Error!!! Time period cannot be zero or negative\n");
			printf("Enter Time Period of Process P%d : ",index);
			scanf("%d",&time_period_array[index]);
		}
		
		printf("Enter Execution Time of Process P%d : ",index);
		scanf("%d",&execution_time_array[index]);
		
		while(execution_time_array[index] <= 0)
		{
			printf("Error!!! Execution Time cannot be zero or negative\n");
			printf("Enter Execution Time of Process P%d : ",index);
			scanf("%d",&execution_time_array[index]);
		}
		
		printf("\n");
	}
	
	double utilization = 0;
	
	for(index=0; index<total_processes; index++)
	{
		utilization += (execution_time_array[index]*1.0)/time_period_array[index];
	}
	
	if(utilization > 1)
		printf("\nThese processes cannot be scheduled since their total CPU Utilization %lf is greater than 100 percent \n\n",utilization*100);
	else if(utilization > (total_processes*((pow(2.0,(1.0/total_processes)))-1)))
	{
		printf("\nThese processes cannot be scheduled since their total CPU utilization %lf is greater than n((2^(1/n))-1) i.e., %lf \n\n",utilization*100,(total_processes*((pow(2.0,(1.0/total_processes)))-1))*100); 
	}
	else
	{
		int current_time = 0;  
		int total_time = LCM_calculator(time_period_array,total_processes);
		int gantt_chart[total_time];  //value of gantt_chart array at index current_time will give name of process which has run from current_time upto current_time+1
		
		bool want_to_work[total_processes];
		
		for(index=0;index<total_processes;index++)
		{
			want_to_work[index] = true;
		}
		
		int execution_time_counter[total_processes];   //for keeping track of which process has completed its execution time within the current time period
		
		for(index=0;index<total_processes;index++)
		{
			execution_time_counter[index] = execution_time_array[index];
		}
		
		int max_priority_process_want_to_work;  //for storing the index of process which has highest priority and its execution time is not completed within the current time period
		
		
		while(current_time < total_time)
		{	
			for(index = 0; index<total_processes; index++)					//for checking if the next time period for a process has been started
			{																				 
				if((current_time) % time_period_array[index] == 0)    
				{
						want_to_work[index] = true;
				}
			}	
			
			max_priority_process_want_to_work = -1;  //assigning -1 because it is possible that all the processes have completed their execution time within the current time_period;
			
			for(index=0; index<total_processes; index++)  //for storing the index of process which has highest priority and its execution time is not completed within the current time period
			{															// if two processes have same priority, then that process is chosen which has lower index
				if(want_to_work[index] == true)
				{
					if(max_priority_process_want_to_work != -1)
					{
						if(time_period_array[index] < time_period_array[max_priority_process_want_to_work])
							max_priority_process_want_to_work = index;
					}
					else 
					{
						max_priority_process_want_to_work = index;
					}
				}
			}
			
			if(max_priority_process_want_to_work != -1)
			{
				gantt_chart[current_time] = max_priority_process_want_to_work;
				execution_time_counter[max_priority_process_want_to_work]--;
				
				if(execution_time_counter[max_priority_process_want_to_work] == 0)
				{
					want_to_work[max_priority_process_want_to_work] = false;
					execution_time_counter[max_priority_process_want_to_work] = execution_time_array[max_priority_process_want_to_work];
				}
			}
			else
				gantt_chart[current_time] = -1;
			
			current_time++;
		}
		
		printGanttChart(gantt_chart,total_time);
		
		for(index=0; index<total_time; index++)
		{
			if(index > 0)
			{
				if(gantt_chart[index] != gantt_chart[index-1])
				{
					printf(",%d\n",index);
					
					if(gantt_chart[index] != -1)
						printf("Process P%d : %d",gantt_chart[index],index);
					else
						printf("IDLE : %d",index);
				}
				else if(index == total_time-1)
				{
					printf(",%d\n",index+1);
				}
			}
			else
				printf("Process P%d : %d",gantt_chart[index],index);
		}
		
		printf("\n");
	}
	
	return 0;
}
