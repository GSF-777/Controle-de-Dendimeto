export function formatarCPF(valor) {
    let cpf = valor.replace(/\D/g, '').slice(0, 11)

    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2')
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2')
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2')

    return cpf
}

export function formatarTelefone(valor) {
    let telefone = valor.replace(/\D/g, '').slice(0, 11)

    telefone = telefone.replace(/^(\d{2})(\d)/, '($1) $2')
    telefone = telefone.replace(/(\d{5})(\d{4})$/, '$1-$2')

    return telefone
}

export function formatarCEP(valor) {
    let cep = valor.replace(/\D/g, '').slice(0, 8)

    cep = cep.replace(/(\d{5})(\d)/, '$1-$2')

    return cep
}