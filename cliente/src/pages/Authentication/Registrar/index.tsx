import React, { useState, ChangeEvent } from 'react';
import { Link } from 'react-router-dom';
import { FiArrowLeft } from 'react-icons/fi';
import Input from 'components/Input'; // Adjust the import based on your actual component
import InputMask from 'react-input-mask';
import api from 'services/api';
import { Container } from './styles';

function validatePassword(password: string, confirmPassword: string) {
  const message = document.getElementById('passwordMatchMessage');

  if (password.length < 8) {
    setMessageError(message, 'A senha deve ter pelo menos 8 caracteres. Tente novamente.');
    return;
  }

  if (password === confirmPassword) {
    setMessageSuccess(message, 'As senhas são iguais!');
    return;
  }

  setMessageError(message, 'As senhas não coincidem. Tente novamente.');
  return;
}

function setMessageError(element: HTMLElement | null, message: string) {
  if (element) {
    element.style.color = 'red';
    element.innerHTML = message;
  }
}

function setMessageSuccess(element: HTMLElement | null, message: string) {
  if (element) {
    element.style.color = 'green';
    element.innerHTML = message;
  }
}

export default function Registrar() {
  const [nome, setNome] = useState('');
  const [numero, setNumero] = useState('');
  const [id_sexo, setId_Sexo] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');

  async function efetuarRegister(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();
    const data = {
      nome,
      numero,
      id_sexo,
      email,
      password,
      password_confirmation: confirmPassword,
    };

    try {
      const res = await api.post('/registrarCliente', data);

      if (res.data.token) {
        const response = await api.post('/registrarCliente', { email, password });
        localStorage.setItem('token', response.data.access_token);
        localStorage.setItem('id_usuario', response.data.id_usuario);
        localStorage.setItem('nome', response.data.nome);
        window.location.href = '/home';
      } else {
      }
    } catch (err) {
      alert('Error registering, please try again.');
    }
  }

  return (
    <Container>
      <form onSubmit={efetuarRegister}>
        <h4 className='text-primary d-flex justify-content-between'>
          <Link className="bg-primary text-white rounded-circle voltar" to="/login">
            <FiArrowLeft size={20} />
          </Link>
          <div className='p-2 w-75'>
            Register Client
          </div>
        </h4>

        <Input
          name="nome"
          placeholder="Name"
          value={nome}
          onChange={(e) => setNome(e.target.value)}
          required
        />
        <InputMask
          className='rounded'
          mask="(99) 9 9999-9999"
          placeholder="Phone"
          value={numero}
          onChange={(e) => setNumero(e.target.value)}
          required
        />
        <select
          className='rounded'
          onChange={(e) => setId_Sexo(e.target.value)}
          required
        >
          <option value={0}>Choose gender</option>
          <option value={1}>Male</option>
          <option value={2}>Female</option>
        </select>
        <Input
          name="email"
          placeholder="Email"
          value={email}
          //          type="email"
          onChange={(e) => setEmail(e.target.value)}
          required
        />
        <Input
          name="password"
          placeholder="Password"
          value={password}  
          //id="password"
          type="password"
          onChange={(e) => setPassword(e.target.value)}
          onKeyUp={() => validatePassword(password,confirmPassword)}
          required
        />

        <Input
          name="confirmPassword"
          placeholder="Confirm Password"
          //id="confirmPassword"
          value={confirmPassword}
          type="password"
          onChange={(e) => setConfirmPassword(e.target.value)}
          onKeyUp={() => validatePassword(password,confirmPassword)}
          required
        />

        <p id="passwordMatchMessage"></p>
        <button className="button" type="submit">
          Register
        </button>
      </form>
      <img src="logo.svg" alt="Logo" />
    </Container>
  );
}
