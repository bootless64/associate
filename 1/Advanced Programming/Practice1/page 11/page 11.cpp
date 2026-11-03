#include<iostream>
using namespace std;
int main()
{
	int num, rev;
	while (1)
	{
		cout << "Enter a number\n";
		cin >> num;
		for (;num != 0;)
		{
			rev = num % 10;
			cout << rev;
			num /= 10;
		}
		cout << "\n";
	}
	return 0;
}