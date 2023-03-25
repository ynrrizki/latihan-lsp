#include <iostream>
#include <conio.h>
#include <algorithm>

using namespace std;

const int MAX_ATTEMPTS = 3;
const int MAX_USERS = 10;
const int MAX_SCORES = 10;

// analogikan ini adalah sebuah table
// table user
struct User
{
    int id;
    string username;
    string password;
    string role;
};

// table score
struct Score
{
    int id;
    float math;
    float physics;
    float ind;
    float eng;
    float oop;
    float average;
};

// inisialisasi struct User
User users[4] = {
    {1, "walas", "12345", "Guru"},
    {2, "Andi", "andi12345", "Siswa"},
    {3, "Fina", "fina12345", "Siswa"},
    {4, "Budi", "budi12345", "Siswa"},
};

// inisialisasi struct Score
Score scores[3] = {
    {2, 75.0, 83.0, 80.0, 90.0, 82.0},
    {3, 77.0, 82.0, 91.0, 95.0, 88.0},
    {4, 89.0, 73.0, 90.0, 79.0, 78.0},
};

// membuat function pengecekkan input dan data yang ada pada table user
bool AuthAttempt(User user, string username, string password)
{
    return (username == user.username && password == user.password);
}

// membuat sebuah function yang merubah inputan password menjadi bintang "****"
string getPrivacyPassword()
{
    string password = "";
    char ch;
    while ((ch = getch()) != '\r')
    {
        if (ch == '\b')
        {
            if (password.length() > 0)
            {
                password.pop_back();
                cout << "\b \b"; // menghapus karakter dari konsol
            }
        }
        else
        {
            password.push_back(ch);
            cout << "*"; // menampilkan bintang
        }
    }
    cout << endl;
    return password;
}

// membuat function untuk mendapatkan nilai rata-rata score
float getAverage(Score &score)
{
    float sum = score.math + score.physics + score.ind + score.eng + score.oop;
    float avg = sum / 5.0;
    score.average = avg;
    return avg;
}

// membuat penyortingan score menggunakan teknik bubble sort
void bubbleSort(Score arr[], int n, bool ascending)
{
    // Calculate average score for each student
    float *avg = new float[n];
    for (int i = 0; i < n; i++)
    {
        avg[i] = getAverage(arr[i]);
    }

    // Sort the array based on average score
    for (int i = 0; i < n - 1; i++)
    {
        for (int j = 0; j < n - i - 1; j++)
        {
            if (ascending)
            {
                if (avg[j] > avg[j + 1])
                {
                    // Swap the scores
                    Score temp = arr[j];
                    arr[j] = arr[j + 1];
                    arr[j + 1] = temp;

                    // Swap the average scores
                    float tempAvg = avg[j];
                    avg[j] = avg[j + 1];
                    avg[j + 1] = tempAvg;
                }
            }
            else
            {
                if (avg[j] < avg[j + 1])
                {
                    // Swap the scores
                    Score temp = arr[j];
                    arr[j] = arr[j + 1];
                    arr[j + 1] = temp;

                    // Swap the average scores
                    float tempAvg = avg[j];
                    avg[j] = avg[j + 1];
                    avg[j + 1] = tempAvg;
                }
            }
        }
    }
}

// screen yang ditampilkan untuk role guru
void guruView()
{
    // menampilkan data secara keseluruhan,
    // tidak ascending ataupun descending
    for (const auto user : users)
    {
        if (user.role != "Guru")
        {
            cout << "\nNilai " << user.username << ": \n";
            for (auto score : scores)
            {
                getAverage(score);
                if (user.id == score.id)
                {
                    cout << "Matematika :" << score.math << endl;
                    cout << "Fisika : " << score.physics << endl;
                    cout << "Bahasa Indonesia : " << score.ind << endl;
                    cout << "Bahasa Inggris : " << score.eng << endl;
                    cout << "OOP : " << score.oop << endl;
                    cout << "rata - rata nilai = " << score.average << endl;
                }
            }
        }
    }
    cout << "\n---- MENU ----\n";
    cout << "1. Urutkan nilai siswa berdasarkan rata-rata (Ascending)" << endl;
    cout << "2. Urutkan nilai siswa berdasarkan rata-rata (Descending)" << endl;
    cout << "3. Kembali ke menu utama" << endl;
    int menuOption;
    cout << "\nMasukkan pilihan menu: ";
    cin >> menuOption;

    switch (menuOption)
    {
    case 1:
        bubbleSort(scores, 3, true);
        cout << "\nNilai Siswa (Ascending):" << endl;
        for (auto score : scores)
        {
            getAverage(score);
            for (const auto user : users)
            {
                if (user.role == "Siswa" && user.id == score.id)
                {
                    cout << user.username << ": " << score.average << endl;
                }
            }
        }
        break;
    case 2:
        bubbleSort(scores, 3, false);
        cout << "\nNilai Siswa (Ascending):" << endl;
        for (auto score : scores)
        {
            getAverage(score);
            for (const auto user : users)
            {
                if (user.role == "Siswa" && user.id == score.id)
                {
                    cout << user.username << ": " << score.average << endl;
                }
            }
        }
        break;
    case 3:
        // do nothing, this will break out of the switch statement
        break;
    default:
        cout << "Pilihan tidak valid. Silakan coba lagi." << endl;
        break;
    }
}

// halaman yang ditampilkan untuk role siswa
void siswaView(User user)
{
    cout << "\nNilai " << user.username << ": \n";
    for (auto score : scores)
    {
        getAverage(score);
        if (user.id == score.id)
        {
            cout << "Matematika :" << score.math << endl;
            cout << "Fisika : " << score.physics << endl;
            cout << "Bahasa Indonesia : " << score.ind << endl;
            cout << "Bahasa Inggris : " << score.eng << endl;
            cout << "OOP : " << score.oop << endl;
            cout << "rata - rata nilai = " << score.average << endl;
        }
    }
};

int main()
{
    string username, password;
    int attempt = 0;
    bool isLogIn = false;
    User currentUser;

    while (attempt < MAX_ATTEMPTS && !isLogIn)
    {
        cout << "\n---- LOGIN ----\n";
        cout << "Username: ";
        string usernameInput;
        cin >> usernameInput;
        cout << "Password: ";
        string passwordInput = getPrivacyPassword();

        for (const auto user : users)
        {
            if (AuthAttempt(user, usernameInput, passwordInput))
            {
                cout << "Login Sukses --> to " << user.role << " PAGE" << endl;
                isLogIn = true;
                currentUser = user;
            }
        }
        if (!isLogIn)
        {
            attempt++;
            cout << "Username atau Password salah, silahkan coba lagi." << endl;
            cout << "Sisa percobaan login: " << MAX_ATTEMPTS - attempt << endl;
        }
    }

    if (currentUser.role == "Guru")
    {
        guruView();
    }
    else
    {
        siswaView(currentUser);
    }
    return 0;
}

// feature:

// - login multi user with array
// - saat "Login Suskes --> to Guru PAGE", maka screennya berpindah ke screen yang berisi table data nilai role Siswa berdasarkan id-nya dan tampilkan juga nama siswa
// - menampilkan data masing-masing atau keseluruhan
//   nilai pada user role siswa,
// - dapat melakukan ascending dan descending
//   pada data nilai siswa