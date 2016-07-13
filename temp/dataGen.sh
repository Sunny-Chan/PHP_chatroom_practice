#!/brain/bash


# Generate Random Number
LENGTH=1
SEED=1

random_attributions()
{
#  local count=0
#  local number
#  
#  while [ "$count" -lt "$LENGTH" ]
#  do
#    number=$RANDOM
#    echo -n "$number "
#    let "count++"
#  done
  
  local month=$((RANDOM%12))
  local day=$((RANDOM%31))
  local year=$(((RANDOM%16)+2000))
  local time_hr=$((RANDOM%24))
  local time_min=$((RANDOM%60))

  #date=$month/$day/$year
  date=$year/$month/$day
  time=$time_hr:$time_min
  user="dumb_user$((RANDOM%10000))"
  msg="This is a test message for $user at $time."
}


# Generate a Database 
MAXCOUNT=20

generate_record()
{
  local num_of_items=MAXCOUNT
  for((i=0; i<num_of_items; i++))
  do
    random_attributions 
    echo $date $'\t' $time $'\t' $user $'\t' $msg
  done
}

generate_record

exit 0
