#include<iostream>
using namespace std;
int main()
{
	int row=1, clo=1;
	for (clo; clo <=10; clo++)
	{
		for (row; row <=10; row++)
		{
			cout << clo << "*" << row << "=" << clo * row<<"\t";
		}
		cout << endl;
		row = 1;
	}
}