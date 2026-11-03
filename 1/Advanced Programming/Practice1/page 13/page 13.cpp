#include <iostream>
using namespace std;
int main()
{
	bool cond = true;
	char ch;
	while (cond)
	{
		cout << "Enter a char (&for exit):";
		cin >> ch;
		if (ch == '&')
			break;
		cout << "the char u entered is:" << ch<<endl;
		ch += 1;
		cout << "next char is :" << ch << endl;
	}
}