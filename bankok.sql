#------------------------------------------------------------
# Database: bankok
#------------------------------------------------------------

CREATE DATABASE bankok;

#------------------------------------------------------------
# Table: Users
#------------------------------------------------------------

CREATE TABLE Users(
        id_user       Int PRIMARY KEY Auto_increment  NOT NULL ,
        last_name     Varchar (50) NOT NULL ,
        first_name    Varchar (50) NOT NULL ,
        user_email    Varchar (50) NOT NULL ,
        user_password Varchar (50) NOT NULL ,
        User_phone    Varchar (50) NOT NULL ,
        date_of_birth Date NOT NULL ,
        id_agency     Int NOT NULL,
        id_adress     Int NOT NULL
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: Agencies
#------------------------------------------------------------

CREATE TABLE Agencies(
        id_agency       Int  PRIMARY KEY Auto_increment  NOT NULL ,
        agency_password Varchar (50) NOT NULL ,
        id_adress       Int NOT NULL
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Adresses
#------------------------------------------------------------

CREATE TABLE Adresses(
        id_adress   Int  PRIMARY KEY Auto_increment  NOT NULL ,
        number      Int NOT NULL ,
        street      Varchar (50) NOT NULL ,
        postal_code Int(5) NOT NULL ,
        city        Varchar (50) NOT NULL ,
        id_user     Int,
        id_agency   Int
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Accounts
#------------------------------------------------------------

CREATE TABLE Accounts(
        id_account        Int  PRIMARY KEY Auto_increment  NOT NULL ,
        account_name      Varchar (25) NOT NULL ,
        rib               Varchar (50) NOT NULL ,
        account_balance   Int NOT NULL ,
        account_overdraft Int NOT NULL ,
        id_user           Int NOT NULL
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Payment methods
#------------------------------------------------------------

CREATE TABLE Payment_methods(
        id_payment_methods    Int  PRIMARY KEY Auto_increment  NOT NULL ,
        payment_method        Enum ("check","credit card") NOT NULL ,
        serial_number         Int NOT NULL ,
        date_of_order         Datetime NOT NULL ,
        payment_method_status Enum ("waiting","valide") NOT NULL ,
        date_of_validation    Datetime ,
        id_account            Int NOT NULL
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Operations
#------------------------------------------------------------

CREATE TABLE Operations(
        id_operation        Int  PRIMARY KEY Auto_increment  NOT NULL ,
        operation_method    Enum ("check","credit card","transfer") NOT NULL ,
        operation_amount    Int NOT NULL ,
        operation_way       Enum ("debit","credit") NOT NULL ,
        operation_date      Datetime NOT NULL ,
        id_account_1        Int NOT NULL,
        id_account_2		Int NOT NULL,
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Beneficiaries
#------------------------------------------------------------

CREATE TABLE Beneficiaries(
        id_benef             Int PRIMARY KEY AUTO_INCREMENT NOT NULL ,
        id_account_1         Int NOT NULL ,
        id_account_2		 Int NOT NULL ,
    	date_of_order		 Datetime NOT NULL,
        beneficiary_status   Enum ("waiting","valide") NOT NULL,
    	date_of_val_benef    Datetime
)ENGINE=InnoDB;

#------------------------------------------------------------
# FOREIGN KEYS
#------------------------------------------------------------

ALTER TABLE users
ADD FOREIGN KEY (id_agency)
REFERENCES agencies(id_agency);

ALTER TABLE users
ADD FOREIGN KEY (id_adress)
REFERENCES adresses(id_adress);

ALTER TABLE agencies
ADD FOREIGN KEY (id_adress)
REFERENCES adresses(id_adress);

ALTER TABLE adresses
ADD FOREIGN KEY (id_user)
REFERENCES users(id_user);

ALTER TABLE adresses
ADD FOREIGN KEY (id_agency)
REFERENCES agencies(id_agency);

ALTER TABLE accounts
ADD FOREIGN KEY (id_user)
REFERENCES users(id_user);

ALTER TABLE payment_methods
ADD FOREIGN KEY (id_account)
REFERENCES accounts(id_account);

ALTER TABLE operations
ADD FOREIGN KEY (id_account_1)
REFERENCES accounts(id_account);

ALTER TABLE operations
ADD FOREIGN KEY (id_account_2)
REFERENCES accounts(id_account);

ALTER TABLE beneficiaries
ADD FOREIGN KEY (id_account_1)
REFERENCES accounts(id_account);

ALTER TABLE beneficiaries
ADD FOREIGN KEY (id_account_2)
REFERENCES accounts(id_account);