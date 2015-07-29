#include <iostream>

#include "guide.h"

Guide::Guide(std::string name, int class_year, std::string major, std::string gender, 
           std::string state, std::string ethnicity, bool public_school, 
           bool athlete, bool study_abroad, int num_tours, std::string avail) :
          
             name(name),
             class_year(class_year),
             major(major),
             gender(gender),
             state(state),
             ethnicity(ethnicity),
             public_school(public_school),
             athlete(athlete), 
			 study_abroad(study_abroad),
			 num_tours(num_tours),
			 times(avail.begin(), avail.end())
			 {}


/*void Guide::set_time (std::string day, std::string time) {
    int day_num, time_num;
    if (!day.compare("Monday"))
        day_num = 0;
    else if (!day.compare("Tuesday"))
        day_num = 1;
    else if (!day.compare("Wednesday"))
        day_num = 2;
    else if (!day.compare("Thursday"))
        day_num = 3;
    else if (!day.compare("Friday"))
        day_num = 4;
    else
        std::cout << "Invalid day." << std::endl;

    if (!time.compare("930"))
        time_num = 0;
    else if (!time.compare("1130"))
        time_num = 1;
    else if (!time.compare("130"))
        time_num = 2;
    else if (!time.compare("330"))
        time_num = 3;
    else
        std::cout << "Invalid time." << std::endl;

    //std::cout << day_num*4 + time_num << std::endl;
    //times[(day_num * 4) + time_num] = 1;
}*/

/*int main() {
    
    Guide g("Dan Cohen", "Male", "White", 2015, "Math", "PA", true, false);
    g.set_time ("Tuesday", "9:30");
    std::cout << g.name << g.gender << g.ethnicity << g.class_year << g.major << g.state << g.public_school << g.athlete << std::endl;

    for(int i = 0; i < 20; i++) {
        std::cout << g.times[i] << std::endl;
    }

return 0;

}*/

