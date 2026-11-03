#include <iostream>
#define NUM 6
using namespace std;
int main()
{
	int i=1;
	float sum=0, x=1.0;
	for (;i <= NUM;i++, x *= 2)
	{
		sum += x / 1;
		cout << "SUM=" << sum << "When count=" << i << endl;
	}

	return 0;
}