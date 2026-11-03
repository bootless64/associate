#include<iostream>
using namespace std;
void function(int x, int y);
int main()
{
	int x, y;
	cout << "Enter first Number:";
	cin >> x;
	cout << "\nEnter 2nd numbert:";
	cin >> y;
	cout << "\n we have x=" << x << " and y=" << y;
	function(x, y);
	cout << "\n we have x=" << x << " and y=" << y;
	return 0;
}
void function(int x, int y)
{
	cout << "\nIn function u give me x= " << x << " and y=" << y;
	x++;
	y++;
	cout << "\nand function's output i:\nx= " << x << " y=" << y;
}