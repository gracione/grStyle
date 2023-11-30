import React from 'react';

interface InputProps {
  name: string;
  placeholder: string;
  value: string;
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
  required: boolean;
  height?: string;
}

const Input: React.FC<InputProps> = ({ name, placeholder, value, onChange, required, height = '30px' }) => {
  return (
    <div className='h-10 mb-1 input'>
    <input
      type="text"
      placeholder={placeholder}
      value={value}
      onChange={onChange}
      required={required}
      style={{ height }}
      name={name}
      />
      </div>
  );
};

export default Input;
