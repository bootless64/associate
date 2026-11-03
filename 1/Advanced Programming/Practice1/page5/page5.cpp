#include<iostream>
using namespace std;
int main()
{
	int c2, c5, c10, c20, c50,couter=0,sum;
	for(c2=0;c2<=50;c2++)
		for(c5=0;c5<=20;c5++)
			for(c10=0;c10<=10;c10++)
				for(c20=0;c20<=5;c20++)
					for (c50 = 0;c50 <= 2;c50++)
					{
						sum = c2 * 2 + c5 * 5 + c10 * 10 + c20 * 20 + c50 * 50;
						if (sum == 100)
						{
							cout << "c2=" << c2 << " c5=" << c5 << " c10=" << c10 << " c20=" << c20 << " c50=" << c50<<endl;
							couter++;
						}

					}
	cout <<"all of answers are :"<< couter << endl;
}