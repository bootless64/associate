#include <iostream>
using namespace std;
int main()
{
	int even = 0, odd = 0, num;
	while (1)
	{
		cout << "Enter a number(0 for exit):";
		cin >> num;
		if (num == 0)
			break;
		else if (num % 2 == 0)
			even++;
		else
			odd++;
	}
}