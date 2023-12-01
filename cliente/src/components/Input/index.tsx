import React from 'react';

interface InputProps {
  name: string;
  placeholder: string;
  value: string;
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
  required: boolean;
  height?: string;
  width?: string;
}

const Input: React.FC<InputProps> = ({ name, placeholder, value, onChange, required, height = '60px', width = '500px' }) => {
  return (
    <input
      type="text"
      placeholder={placeholder}
      value={value}
      onChange={onChange}
      required={required}
      style={{ height, width}}
      name={name}
      />
  );
};

export default Input;
