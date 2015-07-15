#include <ctime>
#include <cstdlib>
#include <sstream>
#include <fstream>
#include <iostream>
#include <algorithm>

#include "candidate.h"

std::map<int, Guide*> guides;
std::vector<std::vector<int> > slots;

bool cmp(Schedule s1, Schedule s2) {
	if (s1.getFitness() <= s2.getFitness()) {
		return 0;
	}
	else return 1;
}

void evaluateIndividuals(std::vector<Schedule> population, int pop_size) {
	double max_fitness = -1;
    for (int i = 0; i < pop_size; i++) {
        double fitness = population[i].evaluate();
        if (fitness > max_fitness) {
            max_fitness = fitness;
        }
    }
	//std::cout << "Max fitness of individual: " << max_fitness << std::endl;
}


bool to_bool(std::string b) {
	if (b.compare("true") == 0) return true;
	return false;
}

int select(std::vector<Schedule> population, int pop_size) {
	int ind1 = rand() % pop_size;
	int ind2 = rand() % pop_size;
	
	//std::cout << ind1 << ", " << ind2 << std::endl;

	if (population[ind1].getFitness() >= population[ind2].getFitness()) {
		return ind1;
	}
	else {
		return ind2;
	}
}

void read_guide_file(char* filename) {
	std::fstream file(filename, std::fstream::in);
	int num_guides = 0;
	
	for (int i = 0; i < NUM_SLOTS/3; i++) {
		std::vector<int> slot_vector;
		slots.push_back(slot_vector);
	}
	if (file.is_open()) {
		std::string line;
		
		while (getline(file, line)) {
			
			std::stringstream ss(line);

			std::string name, class_year, gender, major, ethnicity, state, 
			public_school, athlete, study_abroad, num_tours, avail;
			
			std::getline(ss, name, ',');
			std::getline(ss, gender, ',');
			std::getline(ss, class_year, ',');
			std::getline(ss, major, ',');
			std::getline(ss, state, ',');
			std::getline(ss, ethnicity, ',');
			std::getline(ss, public_school, ',');
			std::getline(ss, athlete, ',');
			std::getline(ss, study_abroad, ',');
			std::getline(ss, num_tours, ',');
			std::getline(ss, avail, ',');
				
			Guide* guide = new Guide(name, std::atoi(class_year.c_str()), major, gender, state, ethnicity, 
						to_bool(public_school), to_bool(athlete), to_bool(study_abroad), 
						std::atoi(num_tours.c_str()), avail);
	
			std::cout << guide->name << guide->gender << guide->ethnicity << guide->class_year << guide->major << guide->state << guide->public_school
					  << guide->athlete << guide->study_abroad << guide->num_tours << ": ";
			
			/*std::string day, time;
			
			while (std::getline(ss, day, '\t')) {
				if (day == "." || day == "") {
					break;
				}
				std::getline(ss, time, '\t');
				guide->set_time(day, time);
			}*/
			
			for (int i = 0; i < 20; i++) {
				if (guide->times[i] == 1) {
					slots[i].push_back(num_guides);
				}
				std::cout << guide->times[i];
			}
			//std::cout << std::endl;
			
			guides[num_guides++] = guide;
			//std::cout << guides[0]->name << std::endl;
		}
	}
	else {
		std::cout << "File did not open." << std::endl;
	}
	file.close();
}

int main(int argc, char* argv[]) {
    std::cout << "Entered program." << std::endl;
	
    srand(time(NULL));
    
    unsigned int pop_size = 20;//std::atoi(argv[1]); // Population size in generation
	int generation = 0;
	double CROSSOVER_PROB = 0.8;
	double MUTATE_PROB = 0.01;

	char* fp = argv[1];//"spring2015_2.txt";
    read_guide_file(fp);
    
    return 0;

	std::vector<Schedule> population;
	Schedule bestIndividual(guides.size());

    for (unsigned int i = 0; i < pop_size; i++) {
        Schedule individual(guides.size());
        individual.evaluate();
        population.push_back(individual);
    }
	while (generation < 3000) {
		std::vector<Schedule> population_next;
	    std::sort(population.begin(), population.end(), cmp);
	    /*for (int i = 0; i < pop_size; i++) {
	    	std::cout << population[i]->getFitness() << ", ";
	    }*/
	    /*for (unsigned int i = 0; i < pop_size; i++) {
			std::cout << "Individual " << i << ": ";
			for (unsigned int j = 0; j < 60; j++) {
				std::cout << population[i].data[j] << ", ";
			}
			std::cout << std::endl;
		}*/
	    std::cout << std::endl;
		std::cout << "Best Individual Fitness: " << population[0].getFitness() << std::endl;
		std::cout << "Generation " << generation << std::endl;
		if (generation % 5000 == 0 && generation != 0) {
			MUTATE_PROB += 0.005;
		}
		population_next.push_back(bestIndividual);
		while (population_next.size() < pop_size) {
			Schedule child1 = population[select(population, pop_size)];
			if (child1.getFitness() > bestIndividual.getFitness()) {
				bestIndividual = child1;
			}
			Schedule child2 = population[select(population, pop_size)];
			if (child2.getFitness() > bestIndividual.getFitness()) {
				bestIndividual = child2;
			}

			child1.crossover(CROSSOVER_PROB, child2);

			child1.mutate(MUTATE_PROB, guides.size());
			child2.mutate(MUTATE_PROB, guides.size());
			
			child1.evaluate();
			child2.evaluate();

			population_next.push_back(child1);
			population_next.push_back(child2);
		}
		generation++;
		population = population_next;
	}
    bestIndividual.print();
    bestIndividual.valid(true);
}

