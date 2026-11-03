#include <iostream>
using namespace std;
long transform(int h, int m, int s);
int main()
{
	int h, m, s;
	long t;
	cout << "This program caculate houre, minutes and second to second!\n Enter hour:\n";
	cin >> h;
	cout << "Enter minutes:\n";
	cin >> m;
	cout << "Enter Second:\n";
	cin >> s;
	t = transform(h, m, s);
	cout << "we have " << t << " second";
}
long transform(int h, int m, int s)
{
	long t;
	h *= 3600;
	m *= 60;
	t = h + m + s;
	return t;
}