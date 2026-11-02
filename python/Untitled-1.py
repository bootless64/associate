class Section:
    def __init__(self, SID, Sname, task):
        self.SID = SID
        self.Sname = Sname
        self.task = task

class Emp(Section):
    def __init__(self, name, EID, section, position, SID, Sname, task):
        super().__init__(SID, Sname, task)
        self.name = name
        self.EID = int(EID)
        self.section = section
        self.position = position

    def promote(self, new_position):
        self.position = new_position
        print(f"{self.name} is now {self.position}")

class Pc(Emp, Section):
    def __init__(self, CID, cpu, gpu, EID, SID, name, section, position, Sname, task):
        super().__init__(name, EID, section, position, SID, Sname, task)
        self.CID = int(CID)
        self.cpu = cpu
        self.gpu = gpu

    def diagnostic(self):
        print(f"PC {self.CID}: CPU={self.cpu}, GPU={self.gpu} -> Status OK")

e = Emp("Alice", 101, "IT", "Junior", "S01", "Software", "Coding")
p = Pc(5001, "Intel i5", "GTX 1650", 101, "S01", "Alice", "IT", "Junior", "Software", "Coding")

print("--- Before method calls ---")
print(f"{e.name}, {e.position}")
p.diagnostic()

print("\n--- After calling methods ---")
e.promote("Team Lead")
p.diagnostic()