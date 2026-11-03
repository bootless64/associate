#include<iostream>
using namespace std;
int max(int x, int y, int z);
int main() 
{
	int x, y, z;
	cout << "Enter first Number:\n";
	cin >> x;
	cout << "Enter second Number:\n";
	cin >> y;
	cout << "Enter third Number:\n";
	cin >> z;
	cout<<"the biggest number is: "<<max(x, y, z)<<endl;
	return 0;
	
}
int max(int x,int y,int z)
{
	int max = x;
	if (y > max)
	{
		max = y;
		if (z > max)
			max = z;
	}
	else if (z > max)
		max = z;
	return max;

}