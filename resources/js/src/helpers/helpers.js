// helper.js

// CPF formatting function
const formatCPF = (value) => {
    // Format CPF in the "XXX.XXX.XXX-XX" format
    return value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
};

// CNPJ formatting function
const formatCNPJ = (value) => {
    // Format CNPJ in the "XX.XXX.XXX/YYYY-ZZ" format
    return value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
};

// CPF/CNPJ validation and formatting function
export const formatCPFCNPJ = (value) => {
    // Remove non-numeric characters
    value = value.replace(/\D/g, '');

    // Check if it's a CPF (11 digits)
    if (value.length === 11) {
        return formatCPF(value);
    }
    // Check if it's a CNPJ (14 digits)
    else if (value.length === 14) {
        return formatCNPJ(value);
    }
    // Return the original value if it's not a valid CPF or CNPJ
    else {
        return value;
    }
};

export const formatEmail = (email) => {
    email = this.email.trim();
    return this.email.toLowerCase();
};

export const validateEmail = (email) => {
    // Expressão regular para validação de endereço de e-mail
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Verificar se o email é válido
    if (emailRegex.test(this.email)) {
        return email;
    } else {
        return false;
    }
};
