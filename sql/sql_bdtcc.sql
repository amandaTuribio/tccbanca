drop database if exists bdtcc;
create database bdtcc;


use bdtcc;

SET SQL_SAFE_UPDATES = 0;


CREATE TABLE orientador(ori_id BIGINT NOT NULL AUTO_INCREMENT,
                        ori_nome VARCHAR(100) NOT NULL,
						ori_email VARCHAR(200) NOT NULL,
                        ori_senha VARCHAR(200) NOT NULL,
                        CONSTRAINT PK_orientador PRIMARY KEY(ori_id),
                        CONSTRAINT UNQ_orientador_email UNIQUE(ori_email));
                        

                        
CREATE TABLE curso(curs_id BIGINT NOT NULL AUTO_INCREMENT,
                   curs_nome VARCHAR(300) NOT NULL,
				   CONSTRAINT PK_curso PRIMARY KEY(curs_id),
                   CONSTRAINT UNQ_curso UNIQUE(curs_nome));
                   

              
              
 CREATE TABLE tcc(tcc_id BIGINT NOT NULL AUTO_INCREMENT,
                 tcc_titulo VARCHAR(200) NOT NULL,
                 tcc_id_orientador BIGINT NOT NULL,
                 tcc_aprov BOOLEAN DEFAULT NULL,
                 CONSTRAINT PK_tcc PRIMARY KEY(tcc_id,tcc_id_orientador),
                 CONSTRAINT FK_tcc_orientador FOREIGN KEY(tcc_id_orientador) REFERENCES orientador(ori_id));
                 
CREATE TABLE aluno(alun_pront VARCHAR(10) NOT NULL,
                   alun_nome VARCHAR(100) NOT NULL,
                   alun_email VARCHAR(200) NOT NULL,
                   alun_id_curso BIGINT NOT NULL,
                   alun_id_tcc BIGINT DEFAULT NULL,
                   CONSTRAINT PK_aluno PRIMARY KEY(alun_pront),
                   CONSTRAINT FK_aluno_curso FOREIGN KEY (alun_id_curso) REFERENCES curso(curs_id),
                   CONSTRAINT FK_aluno_tcc FOREIGN KEY (alun_id_tcc) REFERENCES tcc(tcc_id));
  

                   

CREATE TABLE convite(convt_id BIGINT NOT NULL AUTO_INCREMENT,
                     convt_id_orientador BIGINT NOT NULL,
                     convt_email_convidado VARCHAR(200) NOT NULL,
					 convt_tcc_id BIGINT NOT NULL,
                     convt_dt_prev DATETIME NOT NULL,
                     convt_local VARCHAR(200) NOT NULL,
                     convt_status VARCHAR(200) NOT NULL,
                     convt_dt_status DATETIME NOT NULL,
                     CONSTRAINT PK_convite PRIMARY KEY (convt_id),
                     CONSTRAINT UNQ_convite_tcc_convidado UNIQUE(convt_tcc_id,convt_email_convidado),
                     CONSTRAINT FK_convite_orientador FOREIGN KEY(convt_id_orientador) REFERENCES orientador(ori_id),
                     CONSTRAINT FK_convite_tcc FOREIGN KEY(convt_tcc_id) REFERENCES tcc(tcc_id),
                     CONSTRAINT CHK_convite_status CHECK(convt_dt_status IN('Aceito','Aguardando','Recusado','Cancelado')));

CREATE TABLE membro(memb_cpf BIGINT NOT NULL,
				    memb_nome VARCHAR(200) NOT NULL,
                    memb_login VARCHAR(200) NOT NULL,
                    memb_senha VARCHAR(200) NOT NULL,
                    CONSTRAINT PK_membro PRIMARY KEY(memb_cpf));
                    
CREATE TABLE banca(banca_id BIGINT NOT NULL  AUTO_INCREMENT,
                   banca_tcc_id BIGINT NOT NULL,
                   banca_membro_cpf BIGINT NOT NULL,
                   banca_dt_oficial DATETIME NOT NULL,
                   banca_local_oficial VARCHAR(200) NOT NULL,
                   banca_confirm_pres BOOLEAN DEFAULT NULL,
                   CONSTRAINT PK_banca PRIMARY KEY(banca_id),
                   CONSTRAINT UNQ_banca_tcc_membro UNIQUE(banca_tcc_id,banca_membro_cpf));
       
CREATE TABLE certificado(certf_id BIGINT NOT NULL AUTO_INCREMENT,
						 certf_aluno_pront VARCHAR(10) NOT NULL,
						 certf_tcc_id BIGINT NOT NULL,
						 certf_memb_cpf BIGINT NOT NULL,
						 cert_dt_emi DATETIME NOT NULL,
						 CONSTRAINT PK_certificado PRIMARY KEY(certf_id),
						 CONSTRAINT UNQ_ceriticado_aluno_tcc UNIQUE(certf_aluno_pront,certf_tcc_id),
						 CONSTRAINT UNQ_ceriticado_membro_tcc UNIQUE(certf_memb_cpf,certf_tcc_id),
						 CONSTRAINT FK_certificado_aluno FOREIGN KEY(certf_aluno_pront) REFERENCES aluno(alun_pront),
						 CONSTRAINT FK_certificado_membro FOREIGN KEY(certf_memb_cpf) REFERENCES membro(memb_cpf),
						 CONSTRAINT FK_certificado_tcc FOREIGN KEY(certf_tcc_id) REFERENCES tcc(tcc_id));



INSERT INTO orientador(ori_nome,ori_email,ori_senha)VALUES('GIOVANI','giovani@ifsp.edu.br','12345');
INSERT INTO orientador(ori_nome,ori_email,ori_senha)VALUES('ANTONIO','antonio@ifsp.edu.br','45678');
INSERT INTO orientador(ori_nome,ori_email,ori_senha)VALUES('RODRIGO','rodrigo@ifsp.edu.br','10111');
INSERT INTO curso(curs_nome)VALUES('TECNOLOGIA EM ANÁLISE E DESENVOLVIMENTO DE SISTEMAS');
INSERT INTO curso(curs_nome)VALUES('TECNOLOGIA EM AUTOMAÇÃO INDUSTRIAL');
INSERT INTO curso(curs_nome)VALUES('LICENCIATURA EM MATEMÁTICA');
INSERT INTO curso(curs_nome)VALUES('BACHARELADO EM ENGENHARIA DE CONTROLE E AUTOMAÇÃO');
INSERT INTO aluno(alun_pront,alun_nome,alun_email,alun_id_curso)VALUES('156246-1','Gabriel','gabriel.souzamartins94@gmail.com',1);
INSERT INTO aluno(alun_pront,alun_nome,alun_email,alun_id_curso)VALUES('156245-X','João','joao4@gmail.com',1);

                   /*select * from curso;
                   select * from orientador;
                   select * from aluno;
                   delete from aluno;
                   delete from curso where curs_id >4;
                   
                   
               truncate table curso;*/
                   
                   
                    
