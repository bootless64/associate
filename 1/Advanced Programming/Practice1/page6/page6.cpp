#include <iostream>
using namespace std;
int main()
{
	float sum1, sum, x;
	int i, k, y;
	cout << "Enter radios of x:\n";
	cin >> x;
	cout << "Enter the y:\n";
	cin >> y;
	sum = sum1 = x;
	for (i = 1;i <= y;i++)
	{
		k = (i * 2) + 1;
		sum1 = sum1 * (((x * x) * (-1)) / k * (k * -1));
		sum += sum1;
	}
	cout << sum << endl;

}