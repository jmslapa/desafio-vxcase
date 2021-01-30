const If =  props => {

    const elseChild = getElseChild(props.children)

    const children = getPrimaryChildren(props.children, elseChild)

    if(props.condition) {
        return children
    } else if(elseChild) {
        return elseChild;
    } else {
        return false
    }
}

function getElseChild(children) {
    if(Array.isArray(children)) {
        return children.filter(child => {
            return child.type && child.type.name === 'Else'
        })[0]
    }
    return null;
}

function getPrimaryChildren(children, elseChild) {
    if(elseChild) {
        return children.filter(child => {
            return child !== elseChild
        })
    }
    return children;
}

export default If;

export const Else = props => props.children