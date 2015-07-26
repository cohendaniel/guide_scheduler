/*
 * debug.h
 *
 *  Created on: Jul 22, 2015
 *      Author: Dan
 */

#pragma once

#ifdef DEBUG
#define DEBUG(x) x;
#else
#define DEBUG(x)
#endif
