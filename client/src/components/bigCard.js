import React, { useState } from 'react';
const BigCard = ({recipe, onSelect, isSelected}) => {
    const {name, image} = recipe;
    const handleClick = () => {
        onSelect();
    };

    return (
        <div
            className={`${
                isSelected ? 'bg-gray-200 scale-95' : 'bg-white'
            } p-2 rounded-lg shadow-md flex flex-col items-center cursor-pointer transition duration-300 transform-gpu`}
            style={{ height: '250px', width: '300px' }}
            onClick={handleClick}
        >
            <img style={{width: 190, height: 170, borderRadius: 15}} className={"object-cover"} src={image}/>
            <div style={{
                paddingTop: '9px',
                fontSize: 12,
                fontWeight: 'bold',
                wordWrap: 'break-word',
                textAlign: 'center'
            }} className={"text-active font-mono"}>{name}</div>
            <div style={{
                paddingTop: '9px',
                color: 'black',
                fontSize: 11,
                fontWeight: '400',
                wordWrap: 'break-word',
                textAlign: 'center'
            }} className={"font-mono"}>
                {recipe.tags && recipe.tags.map((tag, index) => {
                    return <span key={tag.id}>{tag.name}{index < recipe.tags.length - 1 && ', '} </span>
                })}
            </div>
        </div>
    );
}

export default BigCard;