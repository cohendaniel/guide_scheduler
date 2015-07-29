#pragma once

#include <iostream>
#include <bitset>
#include <string>
#include <vector>

#include "debug.h"

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
	std::vector<char> times;
  
    Guide(std::string name, int class_year, std::string major, std::string gender, 
           std::string state, std::string ethnicity, bool public_school, 
           bool athlete, bool study_abroad, int num_tours, std::string avail);

    
    //void set_time (std::string day, std::string time);

};  
          
