#include "candidate.h"

#include <cstdlib>

#define NUM_BLOCKS 20
#define NUM_ATTRIBUTES 8
#define SCORE_WEIGHT 0.93

Schedule::Schedule(int num_guides) {
	for (int i = 0; i < NUM_SLOTS; i++) {
        data.push_back(rand() % num_guides);
    }
	fitness = 0.0;
}


void Schedule::mutate(double prob, int num_guides) {
    for (unsigned int i = 0; i < data.size(); i++) {
        if ((double)rand() / RAND_MAX < prob) {
        	int randnum = rand() % slots[i/3].size();
            data[i] = slots[i/3][randnum];
            //std::cout << i << " mutated " << randnum << std::endl;
        }
    }
}

void Schedule::crossover(double prob, Schedule mate) {
	if ((double)rand() / RAND_MAX < prob) {
		int pivot = rand() % NUM_SLOTS;
		for (int i = 0; i < pivot; i++) {
			int temp = data[i];
			data[i] = mate.data[i];
			mate.data[i] = temp;
		}
	}
}

double Schedule::evaluate() {
    double avail_score = 0;
    double attribute_score = 0;
    for (unsigned int i = 0; i < data.size(); i++) {
        if (guides[data[i]]->times[i/3] == '1') {
            avail_score++;
        } 
    }
    for (int i = 0; i < NUM_BLOCKS; i++) {
		int block = i * 3;
		attribute_score += (double)compare_guides(guides[data[block]], guides[data[block+1]], guides[data[block+2]]);
    }
    int N = NUM_BLOCKS * NUM_ATTRIBUTES;
    fitness = (SCORE_WEIGHT)*(avail_score/NUM_SLOTS) * (1/(double)valid(false)) + (1-SCORE_WEIGHT)*(attribute_score/N);
    /*if (!valid(false)) {
    	fitness *= .5;
    	return 0;
    }*/
    return fitness;
}

int Schedule::compare_guides (Guide* g1, Guide* g2, Guide* g3) {
    int attribute_score = 0;
	if (g1->name.compare(g2->name) == 0 || g1->name.compare(g2->name) == 0 || g2->name.compare(g3->name) == 0) {
		//std::cout << "SAME GUIDE IN SLOT" << std::endl;
		//std::cout << g1->name << g2->name << g3->name << std::endl;
		return 0;
	}
	
    if (g1->gender.compare(g2->gender) || g1->gender.compare(g2->gender) || g2->gender.compare(g3->gender))
        attribute_score++;
 
    if (g1->ethnicity.compare(g2->ethnicity) 
        || g1->ethnicity.compare(g2->ethnicity) 
        || g2->gender.compare(g3->ethnicity))
        attribute_score++;

    
    if (g1->state.compare(g2->state) || g1->state.compare(g2->state) || g2->state.compare(g3->state))
        attribute_score++;


    if (g1->major.compare(g2->major) || g1->major.compare(g2->major) || g2->major.compare(g3->major))
        attribute_score++;

    if (g1->class_year!=g2->class_year || g1->class_year!=g3->class_year || g2->class_year!=g3->class_year)
        attribute_score++;

    if ((g1->athlete ^ g2->athlete) || (g1->athlete ^ g3->athlete) || (g2->athlete ^ g3->athlete))
        attribute_score++;
    
    if ((g1->public_school ^ g2->public_school) || (g1->public_school ^ g3->public_school) ||
        (g2->public_school ^ g3->public_school))
        attribute_score++;

    return attribute_score;
} 

double Schedule::getFitness() {
	return fitness;
}

void Schedule::print() {
	for (unsigned int i = 0; i < data.size(); i++) {
		std::cout << data[i] << " ";
	}
	std::cout << std::endl;
	//std::cout << "Fitness: " << fitness << std::endl;
}

void Schedule::print_html() {
	for (unsigned int i = 0; i < data.size(); i++) {
		std::cout << guides[data[i]]->name << ",";
	}
}

int Schedule::valid(bool print) {
	//bool valid = true;
	int count = 0;
	std::vector<int> in_schedule (guides.size(), 0);
	for (unsigned int i = 0; i < data.size(); i++) {
		in_schedule[data[i]]++;
		if (guides[data[i]]->times[i/3] == '0') {
			if (print)std::cout << guides[data[i]]->name << "invalid position at " << i/3 << std::endl;
			//valid = false;
			count++;
		}
		if (i % 3 == 0) {
			if (data[i] == data[i+1] || data[i] == data[i+2] || data[i+1] == data[i+2]) {
				if (print) std::cout << "Same guide in slot " << i/3 << std::endl;
				//valid = false;
				count++;
			}
		}
		if (in_schedule[data[i]] > guides[data[i]]->num_tours) {
			if (print) std::cout << guides[data[i]]->name << " multiple times." << std::endl;
			//valid = false;
			count++;
		}
	}
	if (print) {
		for (unsigned int i = 0; i < data.size(); i++) {
			if (in_schedule[i] == 0) {
				std::cout << guides[i]->name << " not included in schedule." << std::endl;
			}
		}
	}
	if (count == 0) return 1;
	return count + 1;
	/*if (valid) {
		return true;
	}
	else return false;*/
}
