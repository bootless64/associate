#include <iostream>
using namespace std;
int main()
{
	int count=0, i,x,y;
	while (1)
	{
		cout <<"Enter a Number\n";
		cin >> x;
		count++;
		y = x;
		i = 0;
		for (;x > 0;)
		{
			i = i * 10 + x % 10;
			x /= 10;
		}
		if (x == i)
			break;
	}
	cout << count;
	return 0;
}