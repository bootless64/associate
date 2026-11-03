#include <iostream>
using namespace std;
int main()
{
	char chr;
	int counter=0;
	cout << "Enter a statment wich has a . at End of it :\n";
		for (counter;(chr=cin.get()) != '.';counter++)
		{
			cout << counter << endl;
		}
}