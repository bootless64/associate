#include <Arduino.h>
#include <string>


int answer=0;

void setup() {
Serial.begin(9600);
 
}

void loop() {
// answer = power(3, 2);
// Serial.println(answer);
// answer = power(5, 1);
// Serial.println(answer);
// answer = power(9, 0);
// Serial.println(answer);
// answer = power(2, 14);
// Serial.println(answer);
// answer = power(0, 4);
// Serial.println(answer);
// Serial.println("end");
   answer = ALU(3,2,"+");
delay(100);
}


float ALU(int x,int y, String z){
  if (z =="+")
    return x+y;
  else if (z=="-")
  return x-y;
  else if (z=="*"){
    if (x==0||y==0)
    return 0;
    return x*y;
  }
  else if (z=="/"){
    if (x==0||y==0)
    return 0.00;
    return x/y;
  }else if (z=="%"){
    //IDK
  }else
  Serial.println("Invalid Opreation");
  

}


//  int power(int x, int y) {
//   if (y==0)
//     return 1;
//   if (y==1)
//     return x;
//   int res=x;
//   while(y>1){
//     res*=x;
//     y--;
//   }
//   return res;
    
//  }
