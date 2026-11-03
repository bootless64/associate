#include<iostream>
using namespace std;
int x;
void f1(void);
void f2(void);
int main()
{
	int x = 100;
	f1();
	f2();
	cout << "in main x is :" << x;
}
void f1(void)
{
	cout << "in f1 x is:" << x << endl;
}
void f2(void)
{
	int x;
	cout << "x changes"<<endl;
	for (x = 1;x < 4;x++)
	{
		cout << "x=" << x << endl;
	}
	cout << "Global x in f2 is:" << ::x << endl;
}