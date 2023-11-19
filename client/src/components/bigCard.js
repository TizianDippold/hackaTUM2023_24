import React, {useState} from 'react';

const ProgressBar = ({ value }) => {
    const progressStyle = {
        width: `${value * 100}%`,
    };

    return (
        <div className="bg-gray-200 rounded-full h-2" style={{width: '150px'}} >
            <div className="h-full rounded-full bg-greenPastel" style={progressStyle}></div>
        </div>
    );
};

const BigCard = ({recipe, onSelect, isSelected}) => {
    const {name, headline, preptime, image, calories, sustainability_rating} = recipe;
    const handleClick = () => {
        // onSelect();
    };

    return (<div
            className={`${isSelected ? 'bg-gray-200 scale-95' : 'bg-white'} p-2 rounded-lg shadow-md flex flex-col items-left cursor-pointer transition duration-300 transform-gpu`}
            style={{height: '400px', width: '300px', margin: '20px'}}
            onClick={handleClick}
        >
            <img style={{width: 290, height: 170, borderRadius: 15, marginTop: 10}} className={"object-cover"}
                 src={image}/>
            <div style={{
                paddingLeft: '15px',
                paddingTop: '15px',
                fontSize: 18,
                fontWeight: 'bold',
                wordWrap: 'break-word',
                textAlign: 'left'
            }} className={"text-active font-mono"}>{name}</div>

            <div style={{
                paddingLeft: '15px',
                paddingTop: '5px',
                color: 'black',
                fontSize: '13px',
                fontWeight: '400',
                wordWrap: 'break-word',
                textAlign: 'left'
            }} className={"font-mono"}>
                <div className={"pb-2 pr-2"}><span className={"text-active text-sm font-bold"}>Description:</span> <span>{headline}</span></div>
                <div className={"pb-2 pr-2"}><span className={"text-active text-sm font-bold"}>Tags: </span>{recipe.tags && recipe.tags.map((tag, index) => {
                    return <span key={tag.id}>{tag.name}{index < recipe.tags.length - 1 && ', '} </span>
                })}</div>
                <div className={"pb-2 pr-2"}><span className={"text-active text-sm font-bold"}>Preptime:</span><span> {preptime} min</span></div>
                <div className={"pb-2 pr-2"}><span className={"text-active text-sm font-bold"}>{calories} kcal</span></div>
                <div className={"pb-2 pr-2"} style={{display: 'flex', alignItems: 'center', justifyContent: 'space-between'}}><span className={"text-active text-sm font-bold"}>Sustainability: </span> <ProgressBar value={sustainability_rating} /></div>
            </div>

        </div>);
}

export default BigCard;