Here is a clear, well-structured, and “perfect” explanation in English based on your text:

---

## Computer Protection: Cryptography

### What is Cryptography?

Cryptography is the science and practice of protecting information by transforming it so that only authorized people can read and use it. Its main purpose is to keep data secure from unauthorized access.

In cryptography, a normal readable message is called **plaintext** (or cleartext). This plaintext is converted into an unreadable form called **ciphertext** through a process known as **encryption**. Encryption uses a mathematical method (an algorithm or cipher) together with a special piece of information called a **key**.

To read the original message again, the ciphertext must go through the reverse process, called **decryption**, which converts it back into plaintext using the appropriate key. The system is considered secure because the algorithm is difficult to reverse without the correct key.

---

### Types of Cryptography

There are two main types of cryptography, based on the kind of key used:

#### 1. Public Key (Asymmetric) Cryptography

This system uses **two different but related keys**:

* A **public key**, which is shared with everyone
* A **private key**, which is kept secret by the owner

Anyone can use the public key to encrypt a message, but only the person who owns the private key can decrypt it.

An important application of this system is **digital signatures**. A message signed with a sender’s private key can be verified by anyone using the sender’s public key, ensuring authenticity.

---

#### 2. Private Key (Symmetric) Cryptography

This system uses **the same key** for both encryption and decryption.

Both the sender and the receiver must have access to this shared secret key. While this method is usually faster and simpler, it has a major drawback: the key must be securely shared between the parties, which can be risky if intercepted.

---

### Objectives of Cryptography

Modern cryptography is designed to achieve four main goals:

1. **Confidentiality**
   Only authorized people can understand the information.

2. **Integrity**
   The information cannot be changed without detection during storage or transmission.

3. **Non-repudiation**
   The sender cannot deny having sent the message or performed an action.

4. **Authentication**
   Both sender and receiver can verify each other’s identity and confirm the origin of the information.

---

This structured approach ensures that cryptography plays a fundamental role in computer security, protecting data in communication, storage, and digital transactions.




Security Encryption Systems

Computer encryption is based on the science of
1. cryptography, which has been used as long as humans have wanted to keep information secret.

Before the
2. digital age, the biggest users of cryptography were governments, particularly for military purposes. Most forms of cryptography in use these days rely on
3. computers, simply because a human-based code is too easy for a computer to crack. Ciphers are also better known today as
4. algorithms, which are the guides for encryption – they provide a way in which to craft a message and give a certain range of possible
5. combinations. A key, on the other hand, helps a person or computer figure out the one possibility on a given occasion.

Computer encryption systems generally belong in one of two categories:
• Symmetric or private/secret key encryption
• Asymmetric or public-key encryption

In symmetric-key encryption, each computer has a secret key (code) that it can use to
6. encrypt a packet of information before it is sent over the network to another
7. computer. It is essentially the same as a secret code that each of the two computers must know in order to
8. decode the information. The code provides the key to decoding the message.

Also known as asymmetric-key encryption, public-key encryption uses two different
9. keys at once, a combination of a private key and a
10. public key. The private key is known only to your computer, while the public key is given by your computer to any computer that wants to communicate
11. securely with it. To decode an encrypted
12. message, a computer must use the public key, provided by the originating computer, and its own private key.
