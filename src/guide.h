#pragma once

#include "debug.h"

#include <iostream>
#include <bitset>
#include <string>

class Guide {
  public:  
    std::string name;
    int class_year;
    std::string major;
    std::string gender;
    std::string state;
    std::string ethnicity;
    bool public_school;
    bool athlete;
	bool study_abroad;
	int num_tours;
	std::bitset<20> times;
  
    Guide(std::string name, int class_year, std::string major, std::string gender, 
           std::string state, std::string ethnicity, bool public_school, 
           bool athlete, bool study_abroad, int num_tours, std::string avail);

    
    void set_time (std::string day, std::string time);

};  
          
