#include <iostream>
using namespace std;
void f(int x);
int main()
{
	int str[5];
	for (int i = 0;i < 5;i++)
	{
		cout << "Enter a num:\n";
		cin >> str[i];
	}
	for (int num : str)
	{
		cout << num<<endl;
	}
{

}
}