#include<iostream>
using namespace std;
int main()
{
	int c=0;
	cout << "Type somthing (press Enter for Exit):";
	while (cin.get()!='\n')
		c++;
	cout << c<<" char u entered";

}