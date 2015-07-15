#pragma once

#include "guide.h"

#include <vector>
#include <map>

#define NUM_SLOTS 60

extern std::map<int, Guide*> guides;
extern std::vector<std::vector<int> > slots;

class Schedule {
  public:
    std::vector<int> data;

    Schedule(int num_guides);
    void mutate(double prob, int num_guides);
	void crossover(double prob, Schedule mate);
    double evaluate();
    double getFitness();

    void print();
    int valid(bool print);
	
  private:
    int compare_guides(Guide* g1, Guide* g2, Guide* g3);
    double fitness;
};
