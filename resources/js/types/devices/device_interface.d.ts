export interface Device {
    id: number;
    device_name: string;
    device_model: string;
    device_description: string;
    device_serial_number: string;
    device_property_number: string;
    device_delivery_date: string;
    device_aquisition_cost: number;
    device_remarks: string;
    device_deployment_date: string;
    device_warranty_expiration_date: string;
    end_user_id: number;
    status_id: number;
    end_user: {
        id: number;
        end_user_name: string;
    };
    device_type: {
        id: number;
        device_type_name: string;
    };
    brand: {
        id: number;
        brand_name: string;
    };
    status: {
        id: number;
        status_name: string;
    };
    supplier: {
        id: number;
        supplier_name: string;
    };
    arrangement: {
        id: number;
        arrangement_name: string;
    };
}

export interface EndUser {
    id: number;
    end_user_name: string;
}

export interface DeviceType {
    id: number;
    device_type_name: string;
}

export interface Arrangement {
    id: number;
    arrangement_name: string;
}

export interface Status {
    id: number;
    status_name: string;
}

export interface Supplier {
    id: number;
    supplier_name: string;
}

export interface Brand {
    id: number;
    brand_name: string;
}


export interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

export interface PaginatedItemsResponse {
    data: Device[];
    current_page: number;
    from: number;
    to: number;
    total: number;
    per_page: number;
    links: PaginationLink[];
}

export interface DeviceFilters {
    device_type_id?: string;
    arrangement_id?: string;
    status_id?: string;
    warranty_status: string;
}