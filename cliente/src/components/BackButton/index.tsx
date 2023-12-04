import React from 'react';
import { Link } from 'react-router-dom';
import { FiArrowLeft } from 'react-icons/fi';

interface BackButtonProps {
    returnUrl: string;
}

const BackButton: React.FC<BackButtonProps> = ({ returnUrl }) => {
    return (
        <Link to={returnUrl}>
            <FiArrowLeft size={30} />
        </Link>
    );
};

export default BackButton;
