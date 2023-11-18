import React, { useState } from 'react';
const Card = ({recipe, onSelect, isSelected}) => {
    const {name, image} = recipe;
    const handleClick = () => {
        onSelect();
    };

    return (
        <div
            className={`${
                isSelected ? 'bg-gray-200 scale-95' : 'bg-white'
            } p-2 rounded-lg shadow-md flex flex-col items-center cursor-pointer transition duration-300 transform-gpu`}
            style={{ height: '160px', width: '150px' }}
            onClick={handleClick}
        >
            <img style={{width: 125, height: 90, borderRadius: 15}} src={image}/>
            <div style={{
                width: 110,
                height: 33,
                color: 'black',
                fontSize: 12,
                fontFamily: 'Inter',
                fontWeight: '400',
                wordWrap: 'break-word'
            }}>{name}</div>
            {recipe.tags.map(tag => {
               return <p>{tag.name}</p>
            })}
        </div>
    );
}

export default Card;