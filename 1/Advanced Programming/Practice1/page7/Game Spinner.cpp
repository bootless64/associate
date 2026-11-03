#include <iostream>
#include <fstream>
#include <vector>
#include <random>
#include <string>
#include <thread>
#include <chrono>
#include <windows.h> // برای تغییر رنگ و تنظیمات کنسول
#include <iomanip>   // برای setw و setfill

using namespace std;

// تابع تغییر رنگ متن با رنگ‌های ثابت
void setConsoleColor(WORD color) {
    HANDLE hConsole = GetStdHandle(STD_OUTPUT_HANDLE);
    SetConsoleTextAttribute(hConsole, color);
}

// نمایش گردونه
void drawSpinner(int iteration, int currentNumber, int maxDigits, const vector<WORD>& colors) {
    const char spinner[] = { '|', '/', '-', '\\' };
    int colorIndex = iteration % colors.size();
    setConsoleColor(colors[colorIndex]);

    cout << "\r" << string(40, ' ') << "\r"; // پاک کردن خط
    cout << spinner[iteration % 4] << " Spinning... Current number: ";
    cout << setw(maxDigits) << setfill('0') << currentNumber << flush;

    setConsoleColor(7); // بازگشت به رنگ پیش‌فرض سفید
}

int main() {
    SetConsoleOutputCP(65001);
    SetConsoleCP(65001);

    vector<WORD> colors = {
        FOREGROUND_RED | FOREGROUND_INTENSITY,
        FOREGROUND_GREEN | FOREGROUND_INTENSITY,
        FOREGROUND_BLUE | FOREGROUND_INTENSITY,
        FOREGROUND_RED | FOREGROUND_GREEN | FOREGROUND_INTENSITY,
        FOREGROUND_RED | FOREGROUND_BLUE | FOREGROUND_INTENSITY,
        FOREGROUND_GREEN | FOREGROUND_BLUE | FOREGROUND_INTENSITY,
        FOREGROUND_RED | FOREGROUND_GREEN | FOREGROUND_BLUE | FOREGROUND_INTENSITY
    };

    random_device rd;
    mt19937 generator(rd());

    while (true) {
        int minNumber, maxNumber;
        cout << "\nEnter the minimum number of the range (0 to exit): ";
        cin >> minNumber;
        cout << "Enter the maximum number of the range (0 to exit): ";
        cin >> maxNumber;

        if (minNumber == 0 && maxNumber == 0) {
            cout << "Exiting the program. Goodbye!" << endl;
            break;
        }

        if (minNumber >= maxNumber) {
            cout << "Invalid range! Minimum must be less than maximum. Try again." << endl;
            continue;
        }

        vector<int> numbers;
        for (int i = minNumber; i <= maxNumber; ++i) {
            numbers.push_back(i);
        }

        uniform_int_distribution<int> distribution(0, numbers.size() - 1);
        cout << "\nSpinning the wheel...\n" << endl;

        int winningIndex = distribution(generator);
        int winningNumber = numbers[winningIndex];
        int maxDigits = to_string(maxNumber).length();

        // تعداد دفعات چرخش گردونه بین 1 تا 1000
        uniform_int_distribution<int> spinDistribution(1, 1000);
        int totalSpins = spinDistribution(generator);

        for (int i = 0; i < totalSpins; ++i) {
            int temporaryIndex;

            if (i == totalSpins - 1) {
                temporaryIndex = winningIndex;
            }
            else {
                temporaryIndex = distribution(generator);
            }

            int temporaryNumber = numbers[temporaryIndex];
            drawSpinner(i, temporaryNumber, maxDigits, colors);

            this_thread::sleep_for(chrono::milliseconds(200));
        }

        cout << "\n\n>>> Final Number: ";
        setConsoleColor(FOREGROUND_GREEN | FOREGROUND_INTENSITY);
        cout << setw(maxDigits) << setfill('0') << winningNumber;
        setConsoleColor(7);
        cout << " <<<" << endl;

        ifstream inputFile("E:\\data.txt");
        if (!inputFile.is_open()) {
            setConsoleColor(FOREGROUND_RED | FOREGROUND_INTENSITY);
            cout << "Error: Could not open the file!" << endl;
            setConsoleColor(7);
            continue;
        }

        string line;
        int currentLine = 1;
        bool found = false;

        while (getline(inputFile, line)) {
            if (currentLine == winningNumber) {
                cout << "\nWinner's line (Line " << winningNumber << "): ";
                setConsoleColor(FOREGROUND_BLUE | FOREGROUND_INTENSITY);
                cout << line << endl;
                setConsoleColor(7);
                found = true;
                break;
            }
            currentLine++;
        }

        if (!found) {
            setConsoleColor(FOREGROUND_RED | FOREGROUND_INTENSITY);
            cout << "\nNo line found for the winning number: " << winningNumber << endl;
            setConsoleColor(7);
        }
        double dropRate = 100.0 / numbers.size();
        setConsoleColor(14); // Golden color for Drop Rate
        cout << fixed << setprecision(2);
        cout << "Drop Rate: " << dropRate << "% from " << numbers.size() << " total numbers." << endl;
        setConsoleColor(7);

        inputFile.close();
    }


    return 0;
}
