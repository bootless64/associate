import tkinter as tk
from tkinter import ttk, filedialog, messagebox
import pandas as pd

# ─── Classes ────────────────────────────────────────────────────────────────

class doctors:
    def __init__(self, ID, name, phone, specialization, exp, salary=0):
        self.ID = ID; self.name = name; self.phone = phone
        self.specialization = specialization; self.exp = exp; self.salary = salary

    def checkup(self, patient1):
        if self.specialization == patient1.illness:
            print("We can examine you and schedule your appointment...")
        else:
            print("Not the right specialist but we can still examine you...")

    def display_info(self):
        print(f"Doctor: {self.name}, Specialization: {self.specialization}, Experience: {self.exp} years")

    def update_salary(self, new_salary):
        self.salary = new_salary

    def change_specialization(self, new_spec):
        self.specialization = new_spec


class patient:
    def __init__(self, ID, name, age, gender, illness):
        self.ID = ID; self.name = name; self.age = age
        self.gender = gender; self.illness = illness

    def display_info(self):
        print(f"Patient: {self.name}, Age: {self.age}, Illness: {self.illness}")

    def update_illness(self, new_illness):
        self.illness = new_illness

    def get_age_category(self):
        if self.age < 18: return "Child"
        elif self.age < 60: return "Adult"
        else: return "Senior"


class equipment:
    def __init__(self, ID, name, DP, state):
        self.ID = ID; self.name = name; self.DP = DP; self.state = state

    def display_info(self):
        print(f"Equipment: {self.name}, State: {self.state}")

    def change_state(self, new_state):
        self.state = new_state

    def is_available(self):
        return self.state in ("ready", "available")

    def repair(self):
        self.state = "under repair"


class room:
    def __init__(self, ID, name, isfull):
        self.ID = ID; self.name = name; self.isfull = isfull

    def display_info(self):
        print(f"Room {self.name}: {'Full' if self.isfull else 'Empty'}")

    def reserve(self):
        if not self.isfull:
            self.isfull = True; return True
        return False

    def release(self):
        self.isfull = False

    def is_available(self):
        return not self.isfull


class medicine:
    def __init__(self, ID, name, price, quantity):
        self.ID = ID; self.name = name; self.price = price; self.quantity = quantity

    def display_info(self):
        print(f"Medicine: {self.name}, Price: {self.price}, Stock: {self.quantity}")

    def add_stock(self, amount):
        self.quantity += amount

    def sell(self, amount):
        if self.quantity >= amount:
            self.quantity -= amount
            return self.price * amount
        return 0

    def is_low_stock(self, threshold=10):
        return self.quantity < threshold


class manager:
    def __init__(self):
        self.doctors_list = []; self.patients_list = []
        self.equipments_list = []; self.rooms_list = []; self.medicine_list = []

    def add_doctor(self, doctor): self.doctors_list.append(doctor)
    def add_patient(self, p): self.patients_list.append(p)

    def find_doctor_by_specialization(self, spec):
        return [d for d in self.doctors_list if d.specialization == spec]

    def find_available_room(self):
        for r in self.rooms_list:
            if not r.isfull: return r
        return None

    def check_low_stock_medicines(self):
        return [m for m in self.medicine_list if m.is_low_stock()]


# ─── GUI ────────────────────────────────────────────────────────────────────

class HospitalApp(tk.Tk):
    def __init__(self):
        super().__init__()
        self.title("Hospital Management System")
        self.geometry("1100x650")
        self.configure(bg="#f0f4f8")
        self.current_df = None
        self._build_ui()

    def _build_ui(self):
        # Notebook
        style = ttk.Style(self)
        style.theme_use("clam")
        style.configure("TNotebook", background="#f0f4f8", borderwidth=0)
        style.configure("TNotebook.Tab", padding=[16, 8], font=("Segoe UI", 10, "bold"))
        style.configure("Treeview", rowheight=26, font=("Segoe UI", 9))
        style.configure("Treeview.Heading", font=("Segoe UI", 9, "bold"), background="#4a90d9", foreground="white")
        style.map("Treeview", background=[("selected", "#4a90d9")])

        nb = ttk.Notebook(self)
        nb.pack(fill="both", expand=True, padx=12, pady=12)

        # ── Tab 1: File Selector ──────────────────────────────────────────
        tab1 = ttk.Frame(nb)
        nb.add(tab1, text="  📂  Select File  ")

        center = tk.Frame(tab1, bg="#f0f4f8")
        center.place(relx=0.5, rely=0.5, anchor="center")

        tk.Label(center, text="Hospital Management System",
                 font=("Segoe UI", 18, "bold"), bg="#f0f4f8", fg="#2c3e50").pack(pady=(0, 6))
        tk.Label(center, text="Load an Excel file to view hospital data",
                 font=("Segoe UI", 10), bg="#f0f4f8", fg="#7f8c8d").pack(pady=(0, 30))

        btn_frame = tk.Frame(center, bg="#f0f4f8")
        btn_frame.pack()

        tk.Button(btn_frame, text="  Browse Excel File",
                  font=("Segoe UI", 11), bg="#4a90d9", fg="white",
                  activebackground="#357abd", relief="flat", padx=20, pady=10,
                  cursor="hand2", command=lambda: self._browse(nb)
                  ).pack(side="left", padx=6)

        tk.Button(btn_frame, text="  Clear",
                  font=("Segoe UI", 11), bg="#e74c3c", fg="white",
                  activebackground="#c0392b", relief="flat", padx=20, pady=10,
                  cursor="hand2", command=self._clear
                  ).pack(side="left", padx=6)

        self.file_label = tk.Label(center, text="No file selected",
                                   font=("Segoe UI", 9, "italic"), bg="#f0f4f8", fg="#95a5a6")
        self.file_label.pack(pady=(20, 0))

        self.info_label = tk.Label(center, text="",
                                   font=("Segoe UI", 9), bg="#f0f4f8", fg="#27ae60")
        self.info_label.pack(pady=(6, 0))

        # ── Tab 2: Data Viewer ────────────────────────────────────────────
        tab2 = ttk.Frame(nb)
        nb.add(tab2, text="  📊  Data Viewer  ")

        # Toolbar
        toolbar = tk.Frame(tab2, bg="#dce8f5", pady=6)
        toolbar.pack(fill="x")

        tk.Label(toolbar, text="Search:", font=("Segoe UI", 9),
                 bg="#dce8f5").pack(side="left", padx=(10, 4))

        self.search_var = tk.StringVar()
        self.search_var.trace_add("write", self._on_search)
        tk.Entry(toolbar, textvariable=self.search_var,
                 font=("Segoe UI", 9), width=28, relief="flat",
                 highlightthickness=1, highlightbackground="#aaa").pack(side="left", padx=4)

        tk.Label(toolbar, text="Column:", font=("Segoe UI", 9),
                 bg="#dce8f5").pack(side="left", padx=(14, 4))

        self.col_var = tk.StringVar(value="All")
        self.col_combo = ttk.Combobox(toolbar, textvariable=self.col_var,
                                      state="readonly", width=20,
                                      font=("Segoe UI", 9))
        self.col_combo.pack(side="left", padx=4)
        self.col_combo.bind("<<ComboboxSelected>>", self._on_search)

        self.row_count_label = tk.Label(toolbar, text="", font=("Segoe UI", 9),
                                        bg="#dce8f5", fg="#555")
        self.row_count_label.pack(side="right", padx=12)

        # Treeview + scrollbars
        tree_frame = tk.Frame(tab2)
        tree_frame.pack(fill="both", expand=True, padx=8, pady=8)

        self.tree = ttk.Treeview(tree_frame, show="headings")

        vsb = ttk.Scrollbar(tree_frame, orient="vertical", command=self.tree.yview)
        hsb = ttk.Scrollbar(tree_frame, orient="horizontal", command=self.tree.xview)
        self.tree.configure(yscrollcommand=vsb.set, xscrollcommand=hsb.set)

        vsb.pack(side="right", fill="y")
        hsb.pack(side="bottom", fill="x")
        self.tree.pack(fill="both", expand=True)

        # alternating row colors
        self.tree.tag_configure("odd", background="#ffffff")
        self.tree.tag_configure("even", background="#eaf2fb")

        self.nb = nb  # keep reference

    # ── Helpers ──────────────────────────────────────────────────────────────

    def _browse(self, nb):
        path = filedialog.askopenfilename(
            title="Select Excel File",
            filetypes=[("Excel files", "*.xlsx *.xls"), ("All files", "*.*")]
        )
        if not path:
            return
        try:
            df = pd.read_excel(path)
            self.current_df = df
            short = path.split("/")[-1]
            self.file_label.config(text=f"📄 {short}", fg="#2c3e50")
            self.info_label.config(
                text=f"✔  {len(df)} rows × {len(df.columns)} columns loaded"
            )
            self._populate_tree(df)
            nb.select(1)          # switch to viewer tab
        except Exception as e:
            messagebox.showerror("Error", f"Could not read file:\n{e}")

    def _clear(self):
        self.current_df = None
        self.file_label.config(text="No file selected", fg="#95a5a6")
        self.info_label.config(text="")
        self.search_var.set("")
        self.tree.delete(*self.tree.get_children())
        self.tree["columns"] = []
        self.col_combo["values"] = []
        self.row_count_label.config(text="")

    def _populate_tree(self, df):
        self.tree.delete(*self.tree.get_children())
        cols = list(df.columns)
        self.tree["columns"] = cols

        for col in cols:
            self.tree.heading(col, text=col,
                              command=lambda c=col: self._sort_by(c, False))
            max_w = max(len(str(col)), df[col].astype(str).str.len().max())
            self.tree.column(col, width=min(max(max_w * 8, 80), 200), anchor="w")

        for i, (_, row) in enumerate(df.iterrows()):
            tag = "even" if i % 2 == 0 else "odd"
            self.tree.insert("", "end", values=list(row), tags=(tag,))

        self.col_combo["values"] = ["All"] + cols
        self.col_var.set("All")
        self.row_count_label.config(text=f"{len(df)} rows")

    def _on_search(self, *_):
        if self.current_df is None:
            return
        query = self.search_var.get().strip().lower()
        col = self.col_var.get()

        if not query:
            filtered = self.current_df
        else:
            if col == "All":
                mask = self.current_df.astype(str).apply(
                    lambda c: c.str.lower().str.contains(query, na=False)
                ).any(axis=1)
            else:
                mask = self.current_df[col].astype(str).str.lower().str.contains(query, na=False)
            filtered = self.current_df[mask]

        self.tree.delete(*self.tree.get_children())
        for i, (_, row) in enumerate(filtered.iterrows()):
            tag = "even" if i % 2 == 0 else "odd"
            self.tree.insert("", "end", values=list(row), tags=(tag,))
        self.row_count_label.config(text=f"{len(filtered)} rows")

    def _sort_by(self, col, descending):
        if self.current_df is None:
            return
        try:
            data = [(self.tree.set(k, col), k) for k in self.tree.get_children("")]
            try:
                data.sort(key=lambda t: float(t[0]), reverse=descending)
            except ValueError:
                data.sort(key=lambda t: t[0].lower(), reverse=descending)
            for i, (_, k) in enumerate(data):
                self.tree.move(k, "", i)
                tag = "even" if i % 2 == 0 else "odd"
                self.tree.item(k, tags=(tag,))
            self.tree.heading(col, command=lambda: self._sort_by(col, not descending))
        except Exception:
            pass


if __name__ == "__main__":
    app = HospitalApp()
    app.mainloop()
