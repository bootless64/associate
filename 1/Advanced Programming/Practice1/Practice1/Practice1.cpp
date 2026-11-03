#include<iostream>
using namespace std;
int main()
{
	int code;
	char letter = 'a';
	for (;letter <= 'f';letter++)
	{
		code = letter;
		cout << "asci code of letter " << letter <<" is :"<<code << endl;
	}
	return 0;
}
