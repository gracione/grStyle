import React from 'react';
import { Container } from './styles';

interface InputProps {
  name: string;
  placeholder: string;
  value: string;
  type?: string;
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
  required: boolean;
  onKeyUp?: () => void;
  height?: string;
  width?: string;
}

const Input: React.FC<InputProps> = ({
  name,
  placeholder,
  value,
  type = 'text',
  onChange,
  required,
  onKeyUp,
  height = '60px',
  width = '100%',
}) => {
  return (
    <Container>
      <input
        type={type}
        placeholder={placeholder}
        value={value}
        onChange={onChange}
        onKeyUp={onKeyUp}
        required={required}
        style={{ height, width }}
        name={name}
      />
    </Container>
  );
};

export default Input;
