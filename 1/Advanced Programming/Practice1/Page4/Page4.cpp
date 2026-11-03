#include<iostream>
using namespace std;
int main()
{
	long int fact;
	int num, i;
	while (true)
	{
		cout << "enter a number:";
		cin >> num;
		fact = 1;
		for (i=1;i <= num;i++)
			fact *= i;
		cout << fact<<endl;
	}
}
