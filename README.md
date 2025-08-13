# php-form-to-csv

Um projeto simples e elegante que recebe dados enviados por um formulário HTML, valida as informações e as salva automaticamente em um arquivo CSV no servidor.  
Ideal para criar formulários de contato ou coletar dados de usuários de forma rápida.


---

## ✨ Funcionalidades
✅ Formulário HTML estilizado com **Bootstrap 5**  
✅ Validação de campos obrigatórios  
✅ Validação de formato de e-mail  
✅ Salvamento automático no formato **CSV** (separador `;`)  
✅ Compatível com **Excel**, **LibreOffice** e outros editores  

---

## 📂 Estrutura do projeto
php-form-to-csv/

│── index.php # Script principal que processa o formulário

│── index.view2.php # Template HTML do formulário

│── mensagem.csv # Arquivo gerado com os dados enviados

---

## 🚀 Como usar

1. **Clone o repositório**

   ```bash
   git clone https://github.com/seu-usuario/php-form-to-csv.git

2. **Coloque os arquivos no seu servidor PHP**

   Pode ser local (XAMPP, WAMP, Laragon) ou online.

3. **Acesse pelo navegador**

   http://localhost/php-form-to-csv

4. **Preencha o formulário**

   Os dados serão adicionados ao arquivo mensagem.csv com data e hora.


