#include <iostream>
using namespace std;
int main()
{
	int sum = 0, x, y = 0;
	while (1)
	{
		cout << "Enter a Number (0 for exit): \n";
		cin >> x;
		if (x == 0)
			break;
		sum += x * x;
		y++;
	}
	cout << "You Enterd " << y << " number\n"<<"Sum is="<<sum;

}