export function validarNome(valor) {
if (!valor) {
return ''
}

if (valor.trim().length < 3) {
    return 'O nome deve ter pelo menos 3 caracteres.'
}

if (valor.trim().length > 100) {
    return 'O nome pode ter no máximo 100 caracteres.'
}
return ''
}

export function validarCPF(valor) {
const cpf = valor.replace(/\D/g, '')

if (!cpf) {
    return ''
}
if (cpf.length < 11) {
    return 'O CPF deve possuir 11 números.'
}
return ''

}

export function validarTelefone(valor) {
const telefone = valor.replace(/\D/g, '')

if (!telefone) {
    return ''   }

if (telefone.length < 10 || telefone.length > 11) {
    return 'O telefone deve possuir 10 ou 11 números.'
}
return ''
}

export function validarCEP(valor) {
const cep = valor.replace(/\D/g, '')

if (!cep) {
    return ''
}
if (cep.length !== 8) {
    return 'O CEP deve possuir 8 números.'
}
return ''
}
