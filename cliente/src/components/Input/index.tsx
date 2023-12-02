import React from 'react';

interface InputProps {
  name: string;
  placeholder: string;
  value: string;
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
  onChange,
  required,
  onKeyUp,
  height = '60px',
  width = '500px',
}) => {
  return (
    <input
      type="text"
      placeholder={placeholder}
      value={value}
      onChange={onChange}
      onKeyUp={onKeyUp}
      required={required}
      style={{ height, width }}
      name={name}
    />
  );
};

export default Input;
