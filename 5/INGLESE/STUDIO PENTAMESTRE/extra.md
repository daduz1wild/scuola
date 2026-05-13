

Perfetto 👍 ti faccio una **spiegazione completa, chiara e perfetta per studiare/interrogazione** 👇

---

# 🔐 CRYPTOGRAPHY – PERFECT EXPLANATION

## 📌 What is Cryptography?

Cryptography is the **study and practice of protecting information** by transforming it so that **only authorized people can read it**.

👉 In simple terms:

- It hides information from unauthorized users
    

---

## 🔄 Encryption and Decryption

### 🔒 Encryption

Encryption is the process of:

- converting **plaintext (original message)**  
    👉 into
    
- **ciphertext (encoded message)**
    

This is done using:

- a **mathematical algorithm**
    
- a **key** (secret information)
    

👉 Result: the message becomes **unreadable**

---

### 🔓 Decryption

Decryption is the **reverse process**:

- it converts ciphertext back into **readable plaintext**
    

👉 It requires the **correct key**

---

### ⚠️ Why is it secure?

Because:

- the algorithm is **not easily reversible**
    
- without the key, the message cannot be understood
    

---

## 🔑 Types of Cryptography

### 1. Symmetric Cryptography (Private Key)

- Uses **one single key**
    
- Same key for:
    
    - encryption
        
    - decryption
        

👉 Problem:

- both sender and receiver must **share the secret key**, which can be risky
    

---

### 2. Asymmetric Cryptography (Public Key)

- Uses **two keys**:
    
    - **Public key** → shared with everyone
        
    - **Private key** → kept secret
        

👉 How it works:

- anyone can encrypt using the **public key**
    
- only the owner can decrypt using the **private key**
    

👉 Example:

- **Digital signatures**
    

---

## 🎯 Objectives of Cryptography

Modern cryptography has **4 main goals**:

### 1. Confidentiality

- Only authorized people can **read the information**
    

---

### 2. Integrity

- Data **cannot be modified** without detection
    

---

### 3. Non-repudiation

- The sender **cannot deny** sending the message
    

---

### 4. Authentication

- Both sender and receiver can **verify each other’s identity**
    

---

# 🧠 SUPER SUMMARY (DA MEMORIZZARE)

👉 _Cryptography protects data by encrypting it into ciphertext using a key, and decrypting it back into plaintext._

👉 Two types:

- **Symmetric → one key**
    
- **Asymmetric → public + private key**
    

👉 Four objectives:

- Confidentiality
    
- Integrity
    
- Authentication
    
- Non-repudiation
    

---

💡 **Frase perfetta da dire all’orale:**  
👉 _“Cryptography ensures secure communication by encrypting data and guarantees confidentiality, integrity, authentication, and non-repudiation.”_

---

Se vuoi, prossimo passo 🔥:  
➡️ ti faccio le **domande tipiche su questo argomento (molto probabili all’interrogazione)**  
➡️ oppure passiamo a **RSA + HTTPS spiegazione perfetta (super importante)**



Perfect — here are the complete and discursive answers for the **new questions** (I’ll skip the ones already answered, but keep all the others at the same level of detail and in your textbook’s vocabulary and tone).  
We’ll go section by section 👇

---

## 🖥️ **Machine Language and Programming Basics**

**1. What is machine language (or machine code) composed of, and how does a computer interpret this sequence?**  
Machine language, or machine code, is composed of a sequence of 0s and 1s, known as binary code. The computer interprets this sequence electrically as instructions that it can execute directly. Each combination of bits represents a specific command for the computer’s hardware, such as adding numbers or moving data between memory locations.

---

**2. Why is it "almost impossible" for humans to program directly using machine language?**  
It is almost impossible for humans to program directly in machine language because it consists of very long and complex sequences of binary digits. Remembering or writing instructions made only of 0s and 1s is extremely difficult and error-prone. This is why higher-level programming languages were invented, as they are easier for humans to write and understand.

---

**3. What is an algorithm, and what is its role for programmers before writing instructions in a programming language?**  
An algorithm is a detailed sequence of actions that defines how to accomplish a specific task. For programmers, it serves as a plan or model before they start writing the program. It ensures that every step of the problem-solving process is clear, precise, and ordered logically, so that the final program executes the intended task correctly.

---

## ⚙️ **Low-Level and High-Level Languages**

**4. What is the primary function of Low-Level Languages (LLL) in relation to the computer?**  
The primary function of low-level languages is to operate, manage, and manipulate the computer hardware and its components. They are considered closer to the computer because they directly control the physical parts of the system.

---

**5. What are the two examples of machine-dependent, low-level languages mentioned in the text?**  
The two examples of machine-dependent, low-level languages are **machine language** and **assembly language**. Both are specific to a particular type of computer and must be rewritten for a different machine.

---

**6. What characteristic of programs written in a low-level language allows them to be directly executable on the computer hardware?**  
Programs written in low-level languages can be executed directly because they are expressed in a form that the computer hardware can understand without any further translation. In other words, they correspond directly to the machine’s own instruction set.

---

**7. How does the syntax of High-Level Languages (HLL) differ from low-level languages, and what benefit does this provide to the programmer?**  
High-level languages have a syntax that is closer to natural language, such as English, while low-level languages are closer to machine code. This makes high-level languages much easier to learn, read, and write, which allows programmers to focus on solving problems instead of managing hardware details.

---

**8. What key advantage does a high-level language offer regarding its machine-dependency?**  
High-level languages are **not machine-dependent**, meaning that the same program can be used on different types of computers. This portability is a major advantage because programmers do not need to rewrite the code for each hardware system.

---

## 🔄 **Translation Programs**

**9. What is the main function of translation programs in the context of programming languages?**  
Translation programs convert human-readable programming languages into machine code, which the computer can understand and execute. Since computers can only process instructions in binary form, translators make communication between humans and machines possible.

---

**10. Describe the two-step process a compiler uses to convert a program into an executable file, mentioning the two types of programs involved.**  
A compiler converts the entire program at once into an **object file**. Then, a second program called a **linker** takes this object file and converts it into an **executable file** that can be run on the computer.

---

**11. How does an interpreter process the source code differently from a compiler?**  
Unlike a compiler, an interpreter translates and executes the program line by line. It takes each instruction from the source code, converts it into machine code, and immediately executes it before moving to the next line. This makes interpretation slower but allows for easier debugging.

---

**12. What is the specific role of an assembler?**  
An assembler translates programs written in **assembly language** into **machine code**. Each instruction in assembly corresponds directly to one machine instruction, making the translation process straightforward and precise.

---

**13. Which translation program deals specifically with the translation of assembly language?**  
The **assembler** is the translation program that specifically deals with converting assembly language into machine code.

---

**14. Which translation program creates an object file as an intermediate step?**  
The **compiler** is the translation program that produces an **object file** before the final executable file is generated by the linker.

---

**15. Which programming language, if any, does not require a translation program to be directly executable on the computer hardware?**  
**Machine language** is the only language that does not require translation, because it is already in the binary code format that the computer’s hardware can execute directly.


Sure! Here are complete but concise answers using only the vocabulary and style from your textbook 👇

---

*36. What is a word processor used for?**  
A word processor is used to write and manipulate text documents. It allows users to create, edit, save, and print different kinds of texts, such as letters, reports, CVs, and leaflets. It also provides tools for formatting and editing text, making writing tasks easier and faster.

---

**39. What are the main functions of a word processor?**  
The main functions of a word processor are text formatting and text editing. Text formatting deals with the appearance of the text, such as choosing the font type and size or using bold and italics. Text editing focuses on the content, allowing the user to insert, delete, copy, move, or correct text.

---

**40. What is text formatting in a word processor?**  
Text formatting refers to how the text looks on the page. It includes changing the font type and size, bolding, underlining, italicising, and adjusting the layout, such as margins and page orientation. Formatting helps to make the text clearer and more visually attractive.

---

*41. What is text editing in a word processor?**  
Text editing refers to the modification of the content of a document. It includes inserting new text, deleting or moving parts of the text, and copying text to another position. It also includes saving, printing, and correcting spelling and grammar mistakes.

---

**42. What are some important features of word processors?**  
Important features of word processors include layout control, revision tools, and templates. The layout defines the orientation and margins of the page. The revision feature allows multiple users to add notes or corrections that can be accepted or rejected. Templates make repetitive tasks easier by providing ready-made models for letters or documents.

---

**43. How has the use of word processors evolved from earlier versions?**  
Early word processors were simple programs used only to enter and edit text. Today, modern word processors can create more elaborate documents containing graphics, tables, and photos. They can also produce newsletters, web pages, and personalised letters through mail merge. They are now more powerful and often connected to cloud storage.

---

*44. What are some examples of available word processing software?**  
Some examples of word processing software are Microsoft Word, Google Docs, Open Office Writer, Lotus Word Pro, and WPS Writer. Microsoft Word is the major player on the market, while Google Docs and Open Office Writer are free and, in the case of Open Office, also open-source.

---

**45. What is a non-relational database?**  
A non-relational database is a database that is not based on relationships between tables. It stores data in other structures such as single tables, networks, or objects. Non-relational databases include flat-file, network, and object-oriented databases.

---

**46. What is a flat-file database?**  
A flat-file database organises all data sequentially in one single table. It is simple to create and can be made with most spreadsheet or database programs. However, it is less flexible than other types because all data are stored together without relationships.

---

**47. How is data organized in a network database?**  
In a network database, data are organised as entities connected by complex relationships. These entities are represented as nodes in a graph, and some of them can be accessed through several different paths. This structure allows more flexibility than a flat-file database.

---

**48. What is an object-oriented database?**  
An object-oriented database stores data as objects that belong to classes. Each object is defined by its characteristics and methods. For example, the object “oak” belongs to the class “tree” and has specific properties. This type of database is useful when data are naturally organised as objects.

---

**49. What is a relational database?**  
A relational database stores data in separate tables that are linked together by key fields. Each table is made up of records and fields, and the key field uniquely identifies each record. This system allows users to create flexible queries and manage large amounts of information efficiently.

---

**50. Why are relational databases predominant today?**  
Relational databases are predominant because they offer a high level of flexibility and power. They can create complex queries, manage large volumes of data, and ensure data integrity through the use of key fields and a DBMS. They are also very efficient for organising and retrieving information.

---

**51. What is the first step in creating a database?**  
The first step in creating a database is to decide what fields are needed for each table. Each field must have a name, a description of its contents, a data type, and a format. Defining these elements correctly ensures that the database can process and store data accurately.

---

**52. What are the most common data types in databases?**  
The most common data types are text, integers, real numbers, dates, and Boolean data. Text is used for characters, integers for whole numbers, real numbers for decimals, dates for calendar values, and Boolean data for values such as yes/no or true/false.

---

**53. What is metadata in a database?**  
Metadata is data about data. It includes information such as the names and descriptions of tables and fields, the type of each field, and the number of records. It does not contain actual data but explains how data are organised and managed. Metadata also includes a data dictionary and indexes.

---

**54. What is a DBMS (Database Management System)?**  
A DBMS is system software used to create and manage databases. It acts as an interface between the database and application programs. It manages data, the database engine, and the schema. It provides data security, integrity, and administration functions like backup and recovery.

---

**55. What are database applications used for?**  
Database applications are programs that allow users to search, sort, calculate, and report data. They also help share information and protect it with passwords. Examples include Microsoft Access, FileMaker Pro, Oracle, SQL Server, and FoxPro.

---


---

Would you like me to make a **short glossary** of the most useful words from these answers (for oral exam revision)?