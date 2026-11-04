class doctors:
    def __init__(self, ID, name, phone, specialization, exp, salary=0):
        self.ID = ID
        self.name = name
        self.phone = phone
        self.specialization = specialization
        self.exp = exp
        self.salary = salary

    def checkup(self, patient1):
        if self.specialization == patient1.illness:
            print("We can examine you and schedule your appointment...")
        else:
            print("Not the right specialist but we can still examine you...")

    def display_info(self):
        print(f"Doctor: {self.name}, Specialization: {self.specialization}, Experience: {self.exp} years")

    def update_salary(self, new_salary):
        self.salary = new_salary
        print(f"Doctor {self.name}'s salary updated to {new_salary}")

    def change_specialization(self, new_spec):
        self.specialization = new_spec


class patient:
    def __init__(self, ID, name, age, gender, illness):
        self.ID = ID
        self.name = name
        self.age = age
        self.gender = gender
        self.illness = illness

    def display_info(self):
        print(f"Patient: {self.name}, Age: {self.age}, Illness: {self.illness}")

    def update_illness(self, new_illness):
        self.illness = new_illness

    def get_age_category(self):
        if self.age < 18:
            return "Child"
        elif self.age < 60:
            return "Adult"
        else:
            return "Senior"


class equipment:
    def __init__(self, ID, name, DP, state):
        self.ID = ID
        self.name = name
        self.DP = DP
        self.state = state

    def display_info(self):
        print(f"Equipment: {self.name}, State: {self.state}")

    def change_state(self, new_state):
        self.state = new_state
        print(f"{self.name} state changed to {new_state}")

    def is_available(self):
        return self.state == "ready" or self.state == "available"

    def repair(self):
        self.state = "under repair"


class room:
    def __init__(self, ID, name, isfull):
        self.ID = ID
        self.name = name
        self.isfull = isfull

    def display_info(self):
        status = "Full" if self.isfull else "Empty"
        print(f"Room {self.name}: {status}")

    def reserve(self):
        if not self.isfull:
            self.isfull = True
            print(f"Room {self.name} reserved")
            return True
        else:
            print(f"Room {self.name} is full")
            return False

    def release(self):
        self.isfull = False
        print(f"Room {self.name} released")

    def is_available(self):
        return not self.isfull


class medicine:
    def __init__(self, ID, name, price, quantity):
        self.ID = ID
        self.name = name
        self.price = price
        self.quantity = quantity

    def display_info(self):
        print(f"Medicine: {self.name}, Price: {self.price}, Stock: {self.quantity}")

    def add_stock(self, amount):
        self.quantity += amount
        print(f"{amount} units added to {self.name} stock")

    def sell(self, amount):
        if self.quantity >= amount:
            self.quantity -= amount
            total = self.price * amount
            print(f"{amount} units sold. Total: {total}")
            return total
        else:
            print("Insufficient stock")
            return 0

    def is_low_stock(self, threshold=10):
        return self.quantity < threshold


class manager:
    def __init__(self):
        self.doctors_list = []
        self.patients_list = []
        self.equipments_list = []
        self.rooms_list = []
        self.medicine_list = []

    def add_doctor(self, doctor):
        self.doctors_list.append(doctor)
        print(f"Doctor {doctor.name} added")

    def add_patient(self, patient):
        self.patients_list.append(patient)
        print(f"Patient {patient.name} registered")

    def find_doctor_by_specialization(self, specialization):
        result = [d for d in self.doctors_list if d.specialization == specialization]
        return result

    def find_available_room(self):
        for room in self.rooms_list:
            if not room.isfull:
                return room
        return None

    def display_all_doctors(self):
        print("Doctors list:")
        for doc in self.doctors_list:
            doc.display_info()

    def display_all_patients(self):
        print("Patients list:")
        for pat in self.patients_list:
            pat.display_info()

    def check_low_stock_medicines(self):
        low_stock = [m for m in self.medicine_list if m.is_low_stock()]
        if low_stock:
            print("Low stock medicines:")
            for med in low_stock:
                med.display_info()
        return low_stock
