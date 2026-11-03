#include<iostream>
using namespace std;
bool prime(int x);
int main()
{
	int x;
	while(1)
	{	
		cout << "Enter a number: (0 for exit)\n";
		cin >> x;
		if (x == 0)
			break;
		if (prime(x) == 1)
			cout << x << " is a prime Number.\n";
		else
			cout << x << "isn't a prime number\n";
	}
}
bool prime(int x)
{
	bool temp = 1;
	for (int i = 2;(i <= x / 2) && temp;i++)
	{
		if (x % i == 0)
			temp = 0;
	}
	return temp;
}