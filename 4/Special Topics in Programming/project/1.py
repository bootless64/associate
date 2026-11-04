
import tkinter as tk
from tkinter import ttk, filedialog, messagebox
import pandas as pd


# Doctor class

class Doctor:
    def __init__(self, did, name, phone, specialization, exp, salary=0):
        self.did = str(did)
        self.name = name
        self.phone = str(phone)
        self.specialization = specialization
        self.exp = int(exp)
        self.salary = float(salary)


# Patient class

class Patient:
    def __init__(self, pid, name, age, gender, illness):
        self.pid = str(pid)
        self.name = name
        self.age = int(age)
        self.gender = gender
        self.illness = illness


# Equipment class

class Equipment:
    def __init__(self, eid, name, dp, state):
        self.eid = str(eid)
        self.name = name
        self.dp = str(dp)
        self.state = state


# Room class

class Room:
    def __init__(self, rid, name, isfull):
        self.rid = str(rid)
        self.name = name
        self.isfull = bool(isfull)


# Medicine class

class Medicine:
    def __init__(self, mid, name, price, quantity):
        self.mid = str(mid)
        self.name = name
        self.price = float(price)
        self.quantity = int(quantity)


# Manager class

class Manager:
    def __init__(self):
        self.doctors    = []
        self.patients   = []
        self.equipments = []
        self.rooms      = []
        self.medicines  = []

    # Load from Excel — each category is a separate column group
    def load_from_excel(self, path):
        df = pd.read_excel(path)

        self.doctors.clear()
        doc_cols = ["Doctor_ID","Doctor_Name","Doctor_Phone","Doctor_Specialization","Doctor_Experience","Doctor_Salary"]
        if all(c in df.columns for c in doc_cols):
            for _, row in df[doc_cols].dropna(subset=["Doctor_ID"]).iterrows():
                self.doctors.append(Doctor(row["Doctor_ID"], row["Doctor_Name"], row["Doctor_Phone"],
                                        row["Doctor_Specialization"], row["Doctor_Experience"], row["Doctor_Salary"]))

        self.patients.clear()
        pat_cols = ["Patient_ID","Patient_Name","Patient_Age","Patient_Gender","Patient_Illness"]
        if all(c in df.columns for c in pat_cols):
            for _, row in df[pat_cols].dropna(subset=["Patient_ID"]).iterrows():
                self.patients.append(Patient(row["Patient_ID"], row["Patient_Name"],
                                            row["Patient_Age"], row["Patient_Gender"], row["Patient_Illness"]))

        self.equipments.clear()
        equ_cols = ["Equipment_ID","Equipment_Name","Equipment_Department","Equipment_State"]
        if all(c in df.columns for c in equ_cols):
            for _, row in df[equ_cols].dropna(subset=["Equipment_ID"]).iterrows():
                self.equipments.append(Equipment(row["Equipment_ID"], row["Equipment_Name"],
                                                row["Equipment_Department"], row["Equipment_State"]))

        self.rooms.clear()
        room_cols = ["Room_ID","Room_Name","Room_IsFull"]
        if all(c in df.columns for c in room_cols):
            for _, row in df[room_cols].dropna(subset=["Room_ID"]).iterrows():
                self.rooms.append(Room(row["Room_ID"], row["Room_Name"], row["Room_IsFull"]))

        self.medicines.clear()
        med_cols = ["Medicine_ID","Medicine_Name","Medicine_Price","Medicine_Quantity"]
        if all(c in df.columns for c in med_cols):
            for _, row in df[med_cols].dropna(subset=["Medicine_ID"]).iterrows():
                self.medicines.append(Medicine(row["Medicine_ID"], row["Medicine_Name"],
                                            row["Medicine_Price"], row["Medicine_Quantity"]))


    # DataFrame for display / save
    def to_dataframe(self):
        max_len = max(len(self.doctors), len(self.patients),
                      len(self.equipments), len(self.rooms), len(self.medicines), 1)

        def pad(lst, length):
            return lst + [None] * (length - len(lst))

        doc_rows  = [{"DoctorID": d.did, "DoctorName": d.name, "Phone": d.phone,
                      "Specialization": d.specialization, "Experience": d.exp,
                      "Salary": d.salary} for d in self.doctors]
        pat_rows  = [{"PatientID": p.pid, "PatientName": p.name, "Age": p.age,
                      "Gender": p.gender, "Illness": p.illness} for p in self.patients]
        equ_rows  = [{"EquipmentID": e.eid, "EquipmentName": e.name,
                      "DepartmentP": e.dp, "State": e.state} for e in self.equipments]
        room_rows = [{"RoomID": r.rid, "RoomName": r.name,
                      "IsFull": r.isfull} for r in self.rooms]
        med_rows  = [{"MedicineID": m.mid, "MedicineName": m.name,
                      "Price": m.price, "Quantity": m.quantity} for m in self.medicines]

        def rows_to_cols(rows, length):
            if not rows:
                return {}
            keys = rows[0].keys()
            padded = pad(rows, length)
            return {k: [r[k] if r else None for r in padded] for k in keys}

        data = {}
        data.update(rows_to_cols(doc_rows,  max_len))
        data.update(rows_to_cols(pat_rows,  max_len))
        data.update(rows_to_cols(equ_rows,  max_len))
        data.update(rows_to_cols(room_rows, max_len))
        data.update(rows_to_cols(med_rows,  max_len))

        return pd.DataFrame(data)


manager = Manager()


# ─── GUI ────────────────────────────────────────────────────────────────────

root = tk.Tk()
root.title("Hospital Management System")
root.geometry("1100x650")

notebook = ttk.Notebook(root)
notebook.pack(fill="both", expand=True)


# ── Tab: Excel ───────────────────────────────────────────────────────────────

frame_excel = ttk.Frame(notebook)
notebook.add(frame_excel, text="Excel")

def load_excel():
    path = filedialog.askopenfilename(filetypes=[("Excel Files", "*.xlsx")])
    if not path:
        return
    try:
        manager.load_from_excel(path)
        refresh_all()
        messagebox.showinfo("Success", "Excel file loaded successfully.")
    except Exception as e:
        messagebox.showerror("Error", str(e))

def save_excel():
    path = filedialog.asksaveasfilename(defaultextension=".xlsx")
    if not path:
        return
    df = manager.to_dataframe()
    df.to_excel(path, index=False)
    messagebox.showinfo("Saved", "Excel file saved successfully.")

ttk.Button(frame_excel, text="Load Excel File", command=load_excel).pack(pady=10)
ttk.Button(frame_excel, text="Save to Excel File", command=save_excel).pack(pady=10)


# ── Tab: Doctors ─────────────────────────────────────────────────────────────

frame_doctors = ttk.Frame(notebook)
notebook.add(frame_doctors, text="Doctors")

doc_cols = ("ID", "Name", "Phone", "Specialization", "Experience", "Salary")
table_doctors = ttk.Treeview(frame_doctors, columns=doc_cols, show="headings")
for col in doc_cols:
    table_doctors.heading(col, text=col)
    table_doctors.column(col, width=140)
table_doctors.pack(fill="both", expand=True)

def refresh_doctors():
    for i in table_doctors.get_children():
        table_doctors.delete(i)
    for d in manager.doctors:
        table_doctors.insert("", "end",
            values=(d.did, d.name, d.phone, d.specialization, d.exp, d.salary))


# ── Tab: Patients ─────────────────────────────────────────────────────────────

frame_patients = ttk.Frame(notebook)
notebook.add(frame_patients, text="Patients")

pat_cols = ("ID", "Name", "Age", "Gender", "Illness")
table_patients = ttk.Treeview(frame_patients, columns=pat_cols, show="headings")
for col in pat_cols:
    table_patients.heading(col, text=col)
    table_patients.column(col, width=160)
table_patients.pack(fill="both", expand=True)

def refresh_patients():
    for i in table_patients.get_children():
        table_patients.delete(i)
    for p in manager.patients:
        table_patients.insert("", "end",
            values=(p.pid, p.name, p.age, p.gender, p.illness))



def refresh_all():
    refresh_doctors()
    refresh_patients()


root.mainloop()
