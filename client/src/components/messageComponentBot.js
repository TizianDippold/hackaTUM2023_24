
export default function MessageComponentBot(props) {

    const textToDisplay = props.textToDisplay;

    return(
        <div className="flex items-start p-2">
            <div className="bg-gray-400 rounded-lg p-2.5 max-w-xs">
                <div className="text-white text-xs">{textToDisplay}</div>
            </div>
        </div>

    )
}